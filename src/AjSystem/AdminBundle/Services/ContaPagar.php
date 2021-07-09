<?php

namespace AjSystem\AdminBundle\Services;

use AjSystem\AdminBundle\Entity\Filter\FilterContasAPagar;
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

    public function getFilterConta(FilterContasAPagar $filter, $isQuery = false)
    {
        return $this->em->getRepository(\AjSystem\AdminBundle\Entity\ContasAPagar::class)
            ->findConta($filter, $isQuery);
    }

    public function getAPagar(){
        return $this->em->getRepository(\AjSystem\AdminBundle\Entity\ContasAPagar::class)
            ->findPagar();

    }

    public function getPago(){
        return $this->em->getRepository(\AjSystem\AdminBundle\Entity\ContasAPagar::class)
            ->findPago();
    }

}
