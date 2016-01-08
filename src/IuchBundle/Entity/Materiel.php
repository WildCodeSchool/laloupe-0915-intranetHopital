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
    private $date_remise;

    /**
     * @var \DateTime
     */
    private $date_rendu;

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
     * Set date_remise
     *
     * @param \DateTime $date_remise
     *
     * @return Materiel
     */
    public function setDateRemise($date_remise)
    {
        $this->date_remise = $date_remise;

        return $this;
    }

    /**
     * Get date_remise
     *
     * @return \DateTime
     */
    public function getDateRemise()
    {
        return $this->date_remise;
    }

    /**
     * Set date_rendu
     *
     * @param \DateTime $date_rendu
     *
     * @return Materiel
     */
    public function setDateRendu($date_rendu)
    {
        $this->date_rendu = $date_rendu;

        return $this;
    }

    /**
     * Get date_rendu
     *
     * @return \DateTime
     */
    public function getDateRendu()
    {
        return $this->date_rendu;
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
    /**
     * @var \IuchBundle\Entity\TypeMateriel
     */
    private $type;


    /**
     * Set type
     *
     * @param \IuchBundle\Entity\TypeMateriel $type
     *
     * @return Materiel
     */
    public function setType(\IuchBundle\Entity\TypeMateriel $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \IuchBundle\Entity\TypeMateriel
     */
    public function getType()
    {
        return $this->type;
    }
}
