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

    public function isUserEnabled()
    {
        return $this->user->isEnabled();
    }
    //GENERATED CODE

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $date_remise;

    /**
     * @var boolean
     */
    private $rendu;

    /**
     * @var \DateTime
     */
    private $date_rendu;

    /**
     * @var boolean
     */
    private $perdu_vol;

    /**
     * @var string
     */
    private $commentaire;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $intervenant;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $user;

    /**
     * @var \IuchBundle\Entity\TypeMateriel
     */
    private $type;


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
     * Set dateRemise
     *
     * @param \DateTime $dateRemise
     *
     * @return Materiel
     */
    public function setDateRemise($dateRemise)
    {
        $this->date_remise = $dateRemise;

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
     * Set rendu
     *
     * @param boolean $rendu
     *
     * @return Materiel
     */
    public function setRendu($rendu)
    {
        $this->rendu = $rendu;

        return $this;
    }

    /**
     * Get rendu
     *
     * @return boolean
     */
    public function getRendu()
    {
        return $this->rendu;
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
        $this->date_rendu = $dateRendu;

        return $this;
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
     * Set perduVol
     *
     * @param boolean $perduVol
     *
     * @return Materiel
     */
    public function setPerduVol($perduVol)
    {
        $this->perdu_vol = $perduVol;

        return $this;
    }

    /**
     * Get perduVol
     *
     * @return boolean
     */
    public function getPerduVol()
    {
        return $this->perdu_vol;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Materiel
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
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
