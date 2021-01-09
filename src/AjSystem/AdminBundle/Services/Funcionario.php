<?php

namespace AjSystem\AdminBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


class Funcionario
{

    private $tokenStorage;

    public function __construct(EntityManager $entityManager, TokenStorage $tokenStorage)
    {
        $this->em = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    public function getFilterFuncionario($nome = null)
    {
        return $this->em->getRepository(\AjSystem\AdminBundle\Entity\Funcionario::class)
            ->findFuncionario($nome);
    }

}
