<?php

namespace AjSystem\AdminBundle\Services;

use AjSystem\AdminBundle\Entity\Filter\FilterServico;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


class Servico
{

    private $tokenStorage;

    public function __construct(EntityManager $entityManager, TokenStorage $tokenStorage)
    {
        $this->em = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param FilterServico $filter
     * @param bool $isQuery
     * @return mixed
     */
    public function getFilterServico(FilterServico $filter, $isQuery = false)
    {
        return $this->em->getRepository(\AjSystem\AdminBundle\Entity\Servico::class)
            ->findServico($filter, $isQuery);
    }

    /**
     * @return mixed
     */
    public function getCaixa(){
        return $valor = $this->em->getRepository(\AjSystem\AdminBundle\Entity\Servico::class)
            ->findCaixa();
    }

    /**
     * @param FilterServico $filter
     * @return mixed
     */
    public function getCaixaMensal(FilterServico $filter){

        return $this->em->getRepository(\AjSystem\AdminBundle\Entity\Servico::class)
            ->findCaixaMensal($filter);
    }

    /**
     * @return mixed
     */
    public function getReceber(){

        return $this->em->getRepository(\AjSystem\AdminBundle\Entity\Servico::class)
            ->findReceber();
    }

    /**
     * @return mixed
     */
    public function getTotal(){

        return $this->em->getRepository(\AjSystem\AdminBundle\Entity\Servico::class)
            ->findTotal();
    }

}
