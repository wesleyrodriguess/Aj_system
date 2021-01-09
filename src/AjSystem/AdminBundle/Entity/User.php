<?php

namespace AjSystem\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="tipo", type="string")
 * @ORM\DiscriminatorMap({
 *      "ADMINISTRADOR"                   = "AjSystem\AdminBundle\Entity\Administrador",
 *      "FUNCIONARIO"                   = "AjSystem\AdminBundle\Entity\Funcionario"
 * })
 * @UniqueEntity(fields={"email"}, message="Email já cadastrado")
 * @ORM\HasLifecycleCallbacks()
 */
abstract class User Implements UserInterface
{
    const FUNCIONARIO = 'FUNCIONARIO';
    const ADMINISTRADOR = 'ADMINISTRADOR';

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
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\NotBlank(
     *     message="Insira um E-mail"
     * )
     */
    private $email;


    /**
     * @ORM\Column(name="password", type="string", length=255)
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     */
    private $password;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $resetToken;

    /**
     * @ORM\Column(name="roles", type="string", length=255)
     */
    private $roles;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * @var \DateTime
     */
    private $created_at;

    /**
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * Get id
     * @return integer
     */
    public function getId(){
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
     * Get email
     * @return string
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * Get password
     * @return string
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * Get roles
     * @return string
     */
    public function getRoles(){
        return ! $this->roles ? [] : explode(',', $this->roles);
    }


    public function setRoles($roles){
        $this->roles = $roles;

        return $this;
    }

    /**
     * Set active
     * @param boolean $active
     * @return User
     */
    public  function setActive($active){

        $this->active = $active;
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
     * Get created_at
     * @return \DateTime
     */
    public function getCreatedAt(){

        return $this->created_at;
    }


    /**
     * Set nome
     * @param string $nome
     * @return User
     */
    public function setNome($nome){
        $this->nome = $nome;
        $this->created_at = new \DateTime();
        return $this;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function setUpdate(){

        $this->updatedAt = new \DateTime();
    }

    /**
     * Set email
     * @param string $email
     * @return User
     */
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    /**
     * Set password
     * @param string $password
     * @return User
     */
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    /**
     * Get resetToken
     * @return string
     */
    public  function getResetToken(){
        return $this->resetToken;
    }

    /**
     * Set resetToken
     * @param string $resetToken
     * @return User
     */
    public function setResetToken($resetToken){
        $this->resetToken = $resetToken;
        return $this;
    }

    public function getSalt(){
        return null;
    }

    public function getUsername(){
        return $this->email;
    }

    public function eraseCredentials(){

    }
}
