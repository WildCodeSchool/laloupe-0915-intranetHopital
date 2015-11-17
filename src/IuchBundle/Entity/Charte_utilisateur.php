<?php

namespace IuchBundle\Entity;

/**
 * Charte_utilisateur
 */
class Charte_utilisateur
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $signature;

    /**
     * @var \DateTime
     */
    private $dateSignature;


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
     * Set signature
     *
     * @param boolean $signature
     *
     * @return Charte_utilisateur
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get signature
     *
     * @return boolean
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Set dateSignature
     *
     * @param \DateTime $dateSignature
     *
     * @return Charte_utilisateur
     */
    public function setDateSignature($dateSignature)
    {
        $this->dateSignature = $dateSignature;

        return $this;
    }

    /**
     * Get dateSignature
     *
     * @return \DateTime
     */
    public function getDateSignature()
    {
        return $this->dateSignature;
    }
    /**
     * @var \IuchBundle\Entity\Charte
     */
    private $address;


    /**
     * Set address
     *
     * @param \IuchBundle\Entity\Charte $address
     *
     * @return Charte_utilisateur
     */
    public function setAddress(\IuchBundle\Entity\Charte $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \IuchBundle\Entity\Charte
     */
    public function getAddress()
    {
        return $this->address;
    }
    /**
     * @var \IuchBundle\Entity\Charte
     */
    private $charte;


    /**
     * Set charte
     *
     * @param \IuchBundle\Entity\Charte $charte
     *
     * @return Charte_utilisateur
     */
    public function setCharte(\IuchBundle\Entity\Charte $charte = null)
    {
        $this->charte = $charte;

        return $this;
    }

    /**
     * Get charte
     *
     * @return \IuchBundle\Entity\Charte
     */
    public function getCharte()
    {
        return $this->charte;
    }
    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     *
     * @return Charte_utilisateur
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
