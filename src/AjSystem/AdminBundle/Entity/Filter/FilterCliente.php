<?php
namespace AjSystem\AdminBundle\Entity\Filter;

class FilterCliente
{
    private $nome;

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


}