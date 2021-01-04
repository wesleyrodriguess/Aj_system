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
     * @ORM\Column(type="string", length=100)
     */
    private $telefone;

    /**
     * @var float
     * @ORM\Column(name="salario", type="decimal", precision=8, scale=2)
     * @Assert\NotBlank
     */
    protected $salario;

    /**
     * @var float
     * @ORM\Column(name="salario_mensal", type="decimal", precision=8, scale=2)
     */
    protected $salarioMensal;

    /**
     * @var integer
     * @ORM\Column(name="porcentagem", type="integer")
     */
    protected $porcentagem;

    /**
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var Servico
     *
     * @ORM\ManyToMany(targetEntity="AjSystem\AdminBundle\Entity\Servico", mappedBy="responsavel")
     */
    private $servico;

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
     * Set salarilo
     *
     * @param float $salario
     *
     * @return Funcionario
     */
    public function setSalario($salario){

        $this -> salario = $salario;

        return $this;
    }

    /**
     * Get salario
     * @return float
     *
     */
    public function getSalario(){

        return (strpos($this->salario, 'R$') === true) ? 'R$' . number_format($this->salario, 2, ',', '.') : $this->salario;
    }

    /**
     * Set salarioMensal
     *
     * @param float $salarioMensal
     *
     * @return Funcionario
     */
    public function setSalarioMensal($salarioMensal){

        $this -> salarioMensal = $salarioMensal;

        return $this;
    }

    /**
     * Get salarioMensal
     * @return float
     *
     */
    public function getSalarioMensal(){

        return (strpos($this->salarioMensal, 'R$') === true) ? 'R$' . number_format($this->salarioMensal, 2, ',', '.') : $this->salarioMensal;
    }

    /**
     * @param int $porcentagem
     * @return Funcionario
     */
    public function setId($porcentagem)
    {
        $this->porcentagem = $porcentagem;
        return $this;
    }

    /**
     * Get porcentagem
     * @return integer
     */
    public function getPorcentagem(){
        return $this->porcentagem;
    }

    public function getConst(){

        return self::FUNCIONARIO;

    }
}
