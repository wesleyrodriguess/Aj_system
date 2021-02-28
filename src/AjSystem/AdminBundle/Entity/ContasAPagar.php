<?php

namespace AjSystem\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ContasAPagar
 *
 * @ORM\Table(name="contas_a_pagar")
 * @ORM\Entity(repositoryClass="AjSystem\AdminBundle\Repository\ContasAPagarRepository")
 */
class ContasAPagar
{

    //Status 0 = CANCELADO
    //Status 1 = PAGO
    //Status 2 = A PAGAR

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
     * @ORM\Column(name="tipo", type="string", length=100, nullable=true)
     */
    private $tipo;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(name="descricao", type="string", length=100, nullable=true)
     */
    private $descricao;

    /**
     * @var double
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=2)
     * @Assert\NotBlank(
     *     message="Informe o valor"
     * )
     */
    protected $valor;

    /**
     * @ORM\Column(name="data_pago", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $dataPago;

    /**
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updated;

    /**
     * @ORM\Column(name="created", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $created;

    /**
     * @var Funcionario
     * @ORM\ManyToOne(targetEntity="AjSystem\AdminBundle\Entity\Funcionario", inversedBy="salario")
     * @ORM\JoinColumn(name="funcionario_id", referencedColumnName="id", nullable=true)
     **/
    private $funcionario;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

    /**
     * Get id.
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
     * @return ContasAPagar
     */
    public function setNome($nome){
        $this->nome = $nome;
        return $this;
    }

    /**
     * Get tipo
     * @return string
     */
    public function getTipo(){
        return $this->tipo;
    }

    /**
     * Set tipo
     * @param string $tipo
     * @return ContasAPagar
     */
    public function setTipo($tipo){
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * @return int
     */
    public function isStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return ContasAPagar
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get descricao
     * @return string
     */
    public function getDescricao(){
        return $this->descricao;
    }

    /**
     * Set descricao
     * @param string $descricao
     * @return ContasAPagar
     */
    public function setDescricao($descricao){
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * Set valor
     *
     * @param float $valor
     *
     * @return ContasAPagar
     */
    public function setValor($valor){

        if (strpos($valor, 'R$') == false) {
            $valor = str_replace('R$', '', $valor);
            $valor = str_replace('.', '', $valor);
            $valor = str_replace(',', '.', $valor);
            $this->valor = (float) number_format((float) $valor, 2, '.', '');
        }
        return $this;
    }

    /**
     * Get valor
     * @return float
     *
     */
    public function getValor(){
        return strpos($this->valor, 'R$') === false
            ? 'R$' . number_format($this->valor, 2, ',', '.')
            : $this->valor;
    }

    /**
     * Get createdAt
     * @return \DateTime
     */
    public function getCreated(){

        return $this->created;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function setUpdate(){

        $this->updated = new \DateTime();
    }

    /**
     * Set dataPago
     * @param \DateTime $dataPago
     * @return ContasAPagar
     */
    public function setDataPago($dataPago){
        $this->dataPago = $dataPago;
        return $this;
    }

    /**
     * Get dataPago
     * @return \DateTime
     */
    public function getDataPago(){

        return $this->dataPago;
    }

    /**
     * @param mixed $funcionario
     * @return ContasAPagar
     */
    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFuncionario()
    {
        return $this->funcionario;
    }

}
