<?php

namespace AjSystem\AdminBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


class ContaPagar
{

    private $tokenStorage;

    public function __construct(EntityManager $entityManager, TokenStorage $tokenStorage)
    {
        $this->em = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    public function getFilterConta(
        $status = null,
        $dataDe = null,
        $dataAt = null,
        $tipo = null,
        $funcionario = null)
    {
        return $this->em->getRepository(\AjSystem\AdminBundle\Entity\ContasAPagar::class)
            ->findConta($status, $dataDe, $dataAt, $tipo, $funcionario);
    }

    public function getAPagar(){
        $valor =  $this->em->getRepository(\AjSystem\AdminBundle\Entity\ContasAPagar::class)
            ->findPagar();

        return $valor[0][1];
    }

    public function getPago(){
        $valor =  $this->em->getRepository(\AjSystem\AdminBundle\Entity\ContasAPagar::class)
            ->findPago();

        return $valor[0][1];
    }

}
