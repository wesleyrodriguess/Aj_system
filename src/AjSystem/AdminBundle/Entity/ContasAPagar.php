<?php

namespace AjSystem\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContasAPagar
 *
 * @ORM\Table(name="contas_a_pagar")
 * @ORM\Entity(repositoryClass="AjSystem\AdminBundle\Repository\ContasAPagarRepository")
 */
class ContasAPagar
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
