<?php

namespace IuchBundle\Model;

class Signature extends \IuchBundle\Entity\Charte
{
    private $signe = null;
    private $date_signature;
    private $path;
    private $id_charte;

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
    public function setSigne($signe)
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

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function __construct(\IuchBundle\Entity\Charte $charte,\IuchBundle\Entity\Charte_utilisateur $signature = null)
    {
        $this->setFileName($charte->getFileName());
        $this->setCharteFile($charte->getCharteFile());
        $this->setIdCharte($charte->getId());
        $this->setNom($charte->getNom());
        $this->setDescription($charte->getDescription());
        $this->setService($charte->getService());
        $this->setServices($charte->getServices());
        $this->setObligatoire($charte->getObligatoire());

        if (isset($signature)) {
            $this->signe = true;
        } else {
            $this->signe = false;
        }
    }
}
