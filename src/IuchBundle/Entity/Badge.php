<?php

namespace IuchBundle\Entity;

/**
 * Badge
 */
class Badge
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
     * @return Badge
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
     * @return Badge
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
     * @return Badge
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
     * @return Badge
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
}
