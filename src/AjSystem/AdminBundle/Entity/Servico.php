<?php

namespace AjSystem\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Servico
 *
 * @ORM\Table(name="servicos")
 * @ORM\Entity(repositoryClass="AjSystem\AdminBundle\Repository\ServicoRepository")
 */
class Servico
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
     * @ORM\Column(name="nome", type="string", length=100)
     */
    private $nome;

    /**
     * @var float
     * @ORM\Column(name="valor", type="decimal", precision=8, scale=2)
     * @Assert\NotBlank
     */
    protected $valor;

    /**
     * @ORM\Column(name="solicitante", type="string", length=100)
     */
    private $solicitante;

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
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AjSystem\AdminBundle\Entity\Funcionario", cascade={"persist","remove"})
     * @ORM\JoinTable(name="servico_funcionarios",
     *      joinColumns={@ORM\JoinColumn(name="id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="funcionarios_id", referencedColumnName="id")}
     * )
     **/
    private $responsavel;

    public function __construct()
    {
        $this->responsavel = new ArrayCollection();
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
     * @return Servico
     */
    public function setNome($nome){
        $this->nome = $nome;
        $this->createdAt = new \DateTime();
        return $this;
    }

    /**
     * Set valor
     *
     * @param float $valor
     *
     * @return Servico
     */
    public function setValor($valor){

        $this ->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     * @return float
     *
     */
    public function getValor(){

        return (strpos($this->valor, 'R$') === true) ? 'R$' . number_format($this->valor, 2, ',', '.') : $this->valor;
    }

    /**
     * Get solicitante
     * @return string
     */
    public function getSolicitante(){
        return $this->solicitante;
    }

    /**
     * Set solicitante
     * @param string $solicitante
     * @return Servico
     */
    public function setSolicitante($solicitante){
        $this->solicitante = $solicitante;
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
     * @param ArrayCollection $responsavel
     * @return Servico
     */
    public function setResponsavel($responsavel)
    {
        $this->responsavel = $responsavel;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getResponsavel()
    {
        return $this->responsavel;
    }

    public function getResponsavelById($responsavelId) {
        foreach ($this->responsavel as $responsavel) {
            if($responsavel->getId() == $responsavelId)
                return $responsavel;
        }
        return null;
    }
}
