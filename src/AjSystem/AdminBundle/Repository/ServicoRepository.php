<?php

namespace AjSystem\AdminBundle\Repository;

use AjSystem\AdminBundle\Entity\Cliente;
use AjSystem\AdminBundle\Entity\Filter\FilterServico;
use AjSystem\AdminBundle\Entity\Funcionario;
use Doctrine\ORM\QueryBuilder;

/**
 * ServicoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ServicoRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * @param FilterServico $filter
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findCaixaMensal(FilterServico $filter){

        $qb = $this->createQueryBuilder('s');
        $qb->where('s.status != 0');

        $qb = $this->builderQuery($qb, $filter);

        $qb->select('SUM(s.valor)');

        return $qb
            ->getQuery()
            ->useQueryCache(true)
            ->getSingleScalarResult();
    }

    /**
     * @param FilterServico $filter
     * @return mixed
     */
    public function findServico(FilterServico $filter, $isQuery = false)
    {
        $qb = $this->createQueryBuilder('s');
        $qb->where('s.status != 0');

        $qb = $this->builderQuery($qb, $filter);

        $qb
            ->orderBy('s.dataServico', 'DESC');

        if ($isQuery) {
            return $qb
                ->getQuery()
                ->useQueryCache(true);
        }

        return $qb
            ->getQuery()
            ->useQueryCache(true)
            ->useResultCache(true)
            ->getResult();
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findCaixa(){

        $qb = $this->createQueryBuilder('s');

        $qb->where('s.status = 1');

        $qb->select('SUM(s.valor)');

        return $qb
            ->getQuery()
            ->useQueryCache(true)
            ->getSingleScalarResult();
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findReceber(){

        $qb = $this->createQueryBuilder('s');

        $qb->where('s.status = 2');

        $qb->select('SUM(s.valor)');

        return $qb
            ->getQuery()
            ->useQueryCache(true)
            ->getSingleScalarResult();
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findTotal(){

        $qb = $this->createQueryBuilder('s');

        $qb->where('s.status = 1');

        $qb->select('SUM(s.valor)');

        return $qb
            ->getQuery()
            ->useQueryCache(true)
            ->getSingleScalarResult();
    }

    /**
     * @param QueryBuilder $qb
     * @param FilterServico $filter
     * @return QueryBuilder
     */
    public function builderQuery(QueryBuilder $qb, FilterServico $filter)
    {
        try {
            $emConfig = $this->getEntityManager()->getConfiguration();
            $emConfig->addCustomDatetimeFunction('date', 'DoctrineExtensions\Query\Mysql\Date');
        } catch (\Exception $e) {

        }

        if ($filter->getStatus() !== null){
            $qb
                ->where('s.status = :status')
                ->setParameter('status', $filter->getStatus());
        }

        if ($filter->getDataDe()){
            $qb
                ->andWhere('s.dataServico >= :dataDe')
                ->setParameter('dataDe', $filter->getDataDe()->format('Y-m-d'.' '.'00:00:00'));
        }

        if ($filter->getDataAt()){
            $qb
                ->andWhere('s.dataServico <= :dataAt')
                ->setParameter('dataAt', $filter->getDataAt()->format('Y-m-d'.' '.'23:59:59'));
        }

        if ($filter->getCliente()){
            $qb
                ->andWhere('s.cliente = :cliente')
                ->setParameter('cliente', $filter->getCliente());
        }

        if ($filter->getResponsavel()){
            $qb
                ->andWhere('s.responsavel = :funcionario')
                ->setParameter('funcionario', $filter->getResponsavel());
        }

        if (!empty($filter->getNome())){
            $qb
                ->where(
                    $qb->expr()->like('s.nome', ':nome')
                )
                ->setParameter('nome',"%{$filter->getNome()}%");
        }

        if (!empty($filter->getSolicitante())){
            $qb
                ->where(
                    $qb->expr()->like('s.solicitante', ':solicitante')
                )
                ->setParameter('solicitante',"%{$filter->getSolicitante()}%");
        }

        return $qb;
    }
}
