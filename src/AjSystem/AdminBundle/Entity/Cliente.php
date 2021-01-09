<?php

namespace AjSystem\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cliente
 *
 * @ORM\Table(name="cliente")
 * @ORM\Entity(repositoryClass="AjSystem\AdminBundle\Repository\ClienteRepository")
 */
class Cliente
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
     * @ORM\Column(name="nome", type="string", length=100, nullable=true)
     */
    private $nome;

    /**
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(name="telefone", type="string", length=100, nullable=true)
     */
    private $telefone;

    /**
     * @ORM\Column(name="cidade", type="string", length=100, nullable=true)
     */
    private $cidade;

    /**
     * @ORM\Column(name="estado", type="string", length=100, nullable=true)
     */
    private $estado;

    /**
     * @ORM\Column(name="bairro", type="string", length=100, nullable=true)
     */
    private $bairro;

    /**
     * @ORM\Column(name="logradouro", type="string", length=100, nullable=true)
     */
    private $logradouro;

    /**
     * @ORM\Column(name="cep", type="string", length=100, nullable=true)
     */
    private $cep;

    /**
     * @ORM\Column(name="cpf_and_cnpj", type="string", length=100, nullable=true)
     */
    private $cpfAndCnpj;

    /**
     * @ORM\OneToMany(targetEntity="AjSystem\AdminBundle\Entity\Servico", mappedBy="cliente")
     */
    private $servico;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get nome
     * @return string
     */
    public function getNome(){
        return $this->nome;
    }

    /**
     * Set nome
     * @param string $nome
     * @return Cliente
     */
    public function setNome($nome){
        $this->nome = $nome;
        $this->createdAt = new \DateTime();
        return $this;
    }

    /**
     * Get email
     * @return string
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * Set email
     * @param string $email
     * @return Cliente
     */
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    /**
     * Get active
     * @return boolean
     */
    public function getActive(){

        return $this->active;
    }

    /**
     * Set active
     * @param boolean $active
     * @return Cliente
     */
    public  function setActive($active){

        $this->active = $active;
        return $this;
    }

    /**
     * Get createdAt
     * @return \DateTime
     */
    public function getCreatedAt(){

        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function setUpdate(){

        $this->updatedAt = new \DateTime();
    }

    /**
     * Get telefone
     * @return string
     */
    public function getTelefone(){

        return $this->telefone;
    }

    /**
     * Set telefone
     *
     * @param string $telefone
     * @return Cliente
     */
    public function setTelefone($telefone){

        $this -> telefone = $telefone;

        return $this;
    }

    /**
     * Get cidade
     *
     * @return string
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set cidade
     *
     * @param string $cidade
     *
     * @return Cliente
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Cliente
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get bairro
     *
     * @return string
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set bairro
     *
     * @param string $bairro
     *
     * @return Cliente
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get logradouro
     *
     * @return string
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * Set logradouro
     *
     * @param string $logradouro
     *
     * @return Cliente
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    /**
     * Get cep
     *
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set cep
     *
     * @param string $cep
     *
     * @return Cliente
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get cpfAndCnpj
     *
     * @return string
     */
    public function getcpfAndCnpj()
    {
        return $this->cpfAndCnpj;
    }

    /**
     * Set cpfAndCnpj
     *
     * @param string $cpfAndCnpj
     *
     * @return Cliente
     */
    public function setCpfAndCnpj($cpfAndCnpj)
    {
        $this->cpfAndCnpj = $cpfAndCnpj;

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
     * @return Cliente
     */
    public function setServico($servico)
    {
        $this->servico = $servico;
        return $this;
    }
}
