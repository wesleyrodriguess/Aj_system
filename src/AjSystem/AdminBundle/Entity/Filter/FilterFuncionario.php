<?php
namespace AjSystem\AdminBundle\Entity\Filter;

class FilterFuncionario
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
     * @return FilterFuncionario
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }


}