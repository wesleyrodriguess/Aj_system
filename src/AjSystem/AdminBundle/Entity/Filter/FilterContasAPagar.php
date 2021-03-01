<?php
namespace AjSystem\AdminBundle\Entity\Filter;

class FilterContasAPagar
{
    private $nome;
    private $tipo;
    private $status;
    private $dataDe;
    private $dataAt;
    private $funcionario;

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

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getFuncionario()
    {
        return $this->funcionario;
    }

    /**
     * @param mixed $funcionario
     */
    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getDataDe()
    {
        return $this->dataDe;
    }

    /**
     * @param mixed $dataDe
     */
    public function setDataDe($dataDe)
    {
        $this->dataDe = $dataDe;
    }

    /**
     * @return mixed
     */
    public function getDataAt()
    {
        return $this->dataAt;
    }

    /**
     * @param mixed $dataAt
     */
    public function setDataAt($dataAt)
    {
        $this->dataAt = $dataAt;
    }


}