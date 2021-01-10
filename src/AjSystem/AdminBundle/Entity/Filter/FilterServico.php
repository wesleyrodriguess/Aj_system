<?php
namespace AjSystem\AdminBundle\Entity\Filter;

class FilterServico
{
    private $nome;
    private $solicitante;
    private $cliente;
    private $responsavel;
    private $status;
    private $dataDe;
    private $dataAt;

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
    public function getSolicitante()
    {
        return $this->solicitante;
    }

    /**
     * @param mixed $solicitante
     */
    public function setSolicitante($solicitante)
    {
        $this->solicitante = $solicitante;
    }

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * @return mixed
     */
    public function getResponsavel()
    {
        return $this->responsavel;
    }

    /**
     * @param mixed $responsavel
     */
    public function setResponsavel($responsavel)
    {
        $this->responsavel = $responsavel;
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