<?php

namespace IuchBundle\Entity;

/**
 * Admin
 */
class Tenue
{

    public function __construct() {
        $this->date_donnee = new \DateTime('now');
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
    private $date_donnee;

    /**
     * @var integer
     */
    private $nombre_donne;

    /**
     * @var \DateTime
     */
    private $date_rendu;

    /**
     * @var integer
     */
    private $nombre_rendu;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $types;


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
     * Set dateDonnee
     *
     * @param \DateTime $dateDonnee
     *
     * @return Tenue
     */
    public function setDateDonnee($dateDonnee)
    {
        $this->date_donnee = $dateDonnee;

        return $this;
    }

    /**
     * Get dateDonnee
     *
     * @return \DateTime
     */
    public function getDateDonnee()
    {
        return $this->date_donnee;
    }

    /**
     * Set nombreDonne
     *
     * @param integer $nombreDonne
     *
     * @return Tenue
     */
    public function setNombreDonne($nombreDonne)
    {
        $this->nombre_donne = $nombreDonne;

        return $this;
    }

    /**
     * Get nombreDonne
     *
     * @return integer
     */
    public function getNombreDonne()
    {
        return $this->nombre_donne;
    }

    /**
     * Set dateRendu
     *
     * @param \DateTime $dateRendu
     *
     * @return Tenue
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
     * Set nombreRendu
     *
     * @param integer $nombreRendu
     *
     * @return Tenue
     */
    public function setNombreRendu($nombreRendu)
    {
        $this->nombre_rendu = $nombreRendu;

        return $this;
    }

    /**
     * Get nombreRendu
     *
     * @return integer
     */
    public function getNombreRendu()
    {
        return $this->nombre_rendu;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Tenue
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
     * @return Tenue
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
     * @return Tenue
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
     * Add type
     *
     * @param \IuchBundle\Entity\TypeTenue $type
     *
     * @return Tenue
     */
    public function addType(\IuchBundle\Entity\TypeTenue $type)
    {
        $this->types[] = $type;

        return $this;
    }

    /**
     * Remove type
     *
     * @param \IuchBundle\Entity\TypeTenue $type
     */
    public function removeType(\IuchBundle\Entity\TypeTenue $type)
    {
        $this->types->removeElement($type);
    }

    /**
     * Get types
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypes()
    {
        return $this->types;
    }
    /**
     * @var \IuchBundle\Entity\TypeTenue
     */
    private $type;


    /**
     * Set type
     *
     * @param \IuchBundle\Entity\TypeTenue $type
     *
     * @return Tenue
     */
    public function setType(\IuchBundle\Entity\TypeTenue $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \IuchBundle\Entity\TypeTenue
     */
    public function getType()
    {
        return $this->type;
    }
}
