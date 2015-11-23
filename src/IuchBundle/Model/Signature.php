<?php

namespace IuchBundle\Model;
use Application\Sonata\UserBundle\Entity\User;
use IuchBundle\Entity\Charte_utilisateur;

class Signature extends \IuchBundle\Entity\Charte
{
    private $signe = null;
    private $date_signature;
    private $user;


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Signature
     */
    public function setIdCharte($id_charte)
    {
        $this->id_charte = $id_charte;

        return $this;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Signature
     */
    public function getIdCharte()
    {
        return $this->id_charte;
    }

    /**
     * Set signe
     *
     * @param boolean $signe
     *
     * @return Signature
     */
    public function setsigne($signe)
    {
        $this->signe = $signe;

        return $this;
    }

    /**
     * Get signe
     *
     * @return boolean
     */
    public function getSigne()
    {
        return $this->signe;
    }

    /**
     * Set date_signature
     *
     * @param \DateTime $date_signature
     *
     * @return Signature
     */
    public function setDateSignature($date_signature)
    {
        $this->date_signature = $date_signature;

        return $this;
    }

    /**
     * Get date_signature
     *
     * @return \DateTime
     */
    public function getDateSignature()
    {
        return $this->date_signature;
    }

    /**
     * Set user
     *
     * @param string $user
     *
     * @return Signature
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }


    public function __construct(\IuchBundle\Entity\Charte $charte,\IuchBundle\Entity\Charte_utilisateur $signature = null)
    {
        $this->setFichier($charte->getFichier());
        $this->setNom($charte->getNom());
        $this->setDescription($charte->getDescription());
        $this->setService($charte->getService());
        $this->setUser($signature->getUser());


        if ( $soiree->getType() == "repas" ) {
            $this->montant = $soiree->getPrix();
        }

        elseif (isset($inscription))
        {
            $this->montant = $inscription->getMontant();
        }
        else
        {
            $this->setmontant = 0;
        }

        if ( isset($inscription) && $inscription->getPaye() ) {
            $this->setPaye(true);
        }


        if (isset($inscription)) {
            $this->inscrit = true;
        } else {
            $this->inscrit = false;
        }
    }
}