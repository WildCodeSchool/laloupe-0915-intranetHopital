<?php

namespace IuchBundle\Entity;

/**
 * Service
 */
class Service
{

    public function __toString()
    {
        return (string) $this->nom;
    }

    /**
     * Set chefService
     *
     * @param \Application\Sonata\UserBundle\Entity\User $chefService
     *
     * @return Service
     */
    public function setChefService(\Application\Sonata\UserBundle\Entity\User $chef_service = null)
    {
        $this->chef_service = $chef_service;

        return $this;
    }

    // GENERATED CODE
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $telephone;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Service
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Service
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Service
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     *
     * @return Service
     */
    public function addUser(\Application\Sonata\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     */
    public function removeUser(\Application\Sonata\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @var string
     */
    private $uf;


    /**
     * Set uf
     *
     * @param string $uf
     *
     * @return Service
     */
    public function setUf($uf)
    {
        $this->uf = $uf;

        return $this;
    }

    /**
     * Get uf
     *
     * @return string
     */
    public function getUf()
    {
        return $this->uf;
    }
    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $chef_service;

    /**
     * Get chefService
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getChefService()
    {
        return $this->chef_service;
    }
}
