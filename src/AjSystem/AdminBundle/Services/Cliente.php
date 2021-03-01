<?php

namespace AjSystem\AdminBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


class Cliente
{

    private $tokenStorage;

    public function __construct(EntityManager $entityManager, TokenStorage $tokenStorage)
    {
        $this->em = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    public function getFilterCliente($nome = null, $email = null, $cpfAndCnpj = null){

        return $this->em->getRepository(\AjSystem\AdminBundle\Entity\Cliente::class)
            ->findCliente($nome, $email, $cpfAndCnpj);
    }

}
