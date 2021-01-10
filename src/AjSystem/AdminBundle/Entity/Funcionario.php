<?php

namespace AjSystem\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Funcionario
 *
 * @ORM\Table(name="funcionarios")
 * @ORM\Entity(repositoryClass="AjSystem\AdminBundle\Repository\FuncionarioRepository")
 */
class Funcionario extends User
{
    /**
     * @ORM\Column(name="telefone", type="string", length=100, nullable=true)
     */
    private $telefone;


    /**
     * @ORM\OneToMany(targetEntity="AjSystem\AdminBundle\Entity\Servico", mappedBy="responsavel")
     */
    private $servico;

    /**
     * @ORM\OneToMany(targetEntity="AjSystem\AdminBundle\Entity\ContasAPagar", mappedBy="funcionario")
     */
    private $salario;

    /**
     * Set telefone
     *
     * @param string $telefone
     *
     * @return Funcionario
     */
    public function setTelefone($telefone){

        $this -> telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone
     * @return string
     *
     */
    public function getTelefone(){

        return $this->telefone;
    }

    /**
     * @return mixed
     */
    public function getSalario()
    {
        return $this->salario;
    }

    /**
     * @param mixed $salario
     * @return Funcionario
     */
    public function setSalario($salario)
    {
        $this->salario = $salario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getServico()
    {
        return $this->servico;
    }

    /**
     * @param mixed $servico
     * @return Funcionario
     */
    public function setServico($servico)
    {
        $this->servico = $servico;
        return $this;
    }

    public function getConst(){

        return self::FUNCIONARIO;
    }
}
