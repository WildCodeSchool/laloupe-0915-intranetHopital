<?php

namespace IuchBundle\Entity;

/**
 * Cle
 */
class Cle
{

    public function __construct() {
        $this->date_remise = new \DateTime('now');
    }

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
    private $date_remise;

    /**
     * @var string
     */
    private $date_rendu;


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
     * @return Cle
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
     * @return Cle
     */
    public function setDateRemise($date_remise)
    {
        $this->date_remise = $date_remise;

        return $this;
    }

    /**
     * Get dateRemise
     *
     * @return \DateTime
     */
    public function getDateRemise()
    {
        return $this->date_remise;
    }

    /**
     * Set dateRendu
     *
     * @param string $dateRendu
     *
     * @return Cle
     */
    public function setDateRendu($date_rendu)
    {
        $this->date_rendu = $date_rendu;

        return $this;
    }

    /**
     * Get dateRendu
     *
     * @return string
     */
    public function getDate_rendu()
    {
        return $this->date_rendu;
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
     * @return Cle
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
     * Get dateRendu
     *
     * @return \DateTime
     */
    public function getDateRendu()
    {
        return $this->date_rendu;
    }
    /**
     * @var string
     */
    private $intervenant;


    /**
     * Set intervenant
     *
     * @param string $intervenant
     *
     * @return Cle
     */
    public function setIntervenant($intervenant)
    {
        $this->intervenant = $intervenant;

        return $this;
    }

    /**
     * Get intervenant
     *
     * @return string
     */
    public function getIntervenant()
    {
        return $this->intervenant;
    }
}
