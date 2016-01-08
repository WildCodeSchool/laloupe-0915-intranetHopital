<?php

namespace IuchBundle\Entity;

/**
 * Materiel
 */
class Materiel
{
    public function __construct()
    {
        $this->date_remise = new \DateTime('now');
    }

    //GENERATED CODE
    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $remis;

    /**
     * @var \DateTime
     */
    private $dateRemise;

    /**
     * @var \DateTime
     */
    private $dateRendu;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $user;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $intervenant;


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
     * Set remis
     *
     * @param boolean $remis
     *
     * @return Materiel
     */
    public function setRemis($remis)
    {
        $this->remis = $remis;

        return $this;
    }

    /**
     * Get remis
     *
     * @return boolean
     */
    public function getRemis()
    {
        return $this->remis;
    }

    /**
     * Set dateRemise
     *
     * @param \DateTime $dateRemise
     *
     * @return Materiel
     */
    public function setDateRemise($dateRemise)
    {
        $this->dateRemise = $dateRemise;

        return $this;
    }

    /**
     * Get dateRemise
     *
     * @return \DateTime
     */
    public function getDateRemise()
    {
        return $this->dateRemise;
    }

    /**
     * Set dateRendu
     *
     * @param \DateTime $dateRendu
     *
     * @return Materiel
     */
    public function setDateRendu($dateRendu)
    {
        $this->dateRendu = $dateRendu;

        return $this;
    }

    /**
     * Get dateRendu
     *
     * @return \DateTime
     */
    public function getDateRendu()
    {
        return $this->dateRendu;
    }

    /**
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     *
     * @return Materiel
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

    /**
     * Set intervenant
     *
     * @param \Application\Sonata\UserBundle\Entity\User $intervenant
     *
     * @return Materiel
     */
    public function setIntervenant(\Application\Sonata\UserBundle\Entity\User $intervenant = null)
    {
        $this->intervenant = $intervenant;

        return $this;
    }

    /**
     * Get intervenant
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getIntervenant()
    {
        return $this->intervenant;
    }
}
