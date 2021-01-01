<?php

namespace AjSystem\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Administrador
 *
 * @ORM\Table(name="administradores")
 * @ORM\Entity(repositoryClass="AjSystem\AdminBundle\Repository\AdministradorRepository")
 */
class Administrador extends User
{
    public function getConst(){

        return self::ADMINISTRADOR;

    }
}
