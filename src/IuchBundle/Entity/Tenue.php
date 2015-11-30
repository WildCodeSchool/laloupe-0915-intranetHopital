<?php

namespace IuchBundle\Entity;

/**
 * Admin
 */
class Tenue
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

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
     * @return Tenue
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
     * Set date_donnee
     *
     * @param \DateTime $date_donnee
     * @param \DateTime $date_donnee
     *
     * @return Tenue
     */
    public function setDateDonnee($date_donnee)
    {
        $this->date_donnee = $date_donnee;

        return $this;
    }

    /**
     * Get date_donnee
     *
     * @return \DateTime
     */
    public function getDateDonnee()
    {
        return $this->date_donnee;
    }

    /**
     * Set nombre_donne
     *
     * @param integer $nombre_donne
     *
     * @return Tenue
     */
    public function setNombreDonne($nombre_donne)
    {
        $this->nombre_donne = $nombre_donne;

        return $this;
    }

    /**
     * Get nombre_donne
     *
     * @return integer
     */
    public function getNombreDonne()
    {
        return $this->nombre_donne;
    }

    /**
     * Set date_rendu
     *
     * @param \DateTime $date_rendu
     *
     * @return Tenue
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
     * Set nombre_rendu
     *
     * @param integer $nombre_rendu
     *
     * @return Tenue
     */
    public function setNombreRendu($nombre_rendu)
    {
        $this->nombre_rendu = $nombre_rendu;

        return $this;
    }

    /**
     * Get nombre_rendu
     *
     * @return integer
     */
    public function getNombreRendu()
    {
        return $this->nombre_rendu;
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
}
