<?php
namespace AjSystem\AdminBundle\Entity\Filter;

class FilterServico
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
     * @return FilterServico
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }


}