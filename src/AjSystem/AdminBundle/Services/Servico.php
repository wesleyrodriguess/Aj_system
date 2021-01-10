<?php

namespace AjSystem\AdminBundle\Services;

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

    public function getFilterServico(
        $status = null,
        $dataDe = null,
        $dataAt = null,
        $cliente = null,
        $funcionario = null,
        $nome = null,
        $solicitante = null)
    {
        return $this->em->getRepository(\AjSystem\AdminBundle\Entity\Servico::class)
            ->findServico($status, $dataDe, $dataAt, $cliente, $funcionario, $nome,$solicitante);
    }

}
