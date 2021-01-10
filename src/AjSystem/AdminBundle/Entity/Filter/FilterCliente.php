<?php
namespace AjSystem\AdminBundle\Entity\Filter;

class FilterCliente
{
    private $nome;
    private $email;
    private $cpfAndCnpj;

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     * @return FilterCliente
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return FilterCliente
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCpfAndCnpj()
    {
        return $this->cpfAndCnpj;
    }

    /**
     * @param mixed $cpfAndCnpj
     * @return FilterCliente
     */
    public function setCpfAndCnpj($cpfAndCnpj)
    {
        $this->cpfAndCnpj = $cpfAndCnpj;
    }




}