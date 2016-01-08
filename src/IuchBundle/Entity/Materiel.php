<?php

namespace IuchBundle\Entity;

/**
 * Materiel
 */
class Materiel
{
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
}
