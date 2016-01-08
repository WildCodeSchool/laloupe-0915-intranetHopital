<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;


/**
 * This file has been generated by the Sonata EasyExtends bundle ( http://sonata-project.org/bundles/easy-extends )
 *
 * References :
 *   working with object : http://www.doctrine-project.org/projects/orm/2.0/docs/reference/working-with-objects/en
 *
 * @author <yourname> <youremail>
 */


class User extends BaseUser
{

    public function __construct()
    {
        parent::__construct();
        $this->enabled = true;
        $this->dateOfBirth = new \DateTime('1950-01-01');
    }

    public function __toString()
    {
        return (string) $this->username.' - '.$this->firstname.' '.$this->lastname;
    }

    //GENERATED CODE

    /**
     * @var string
     */
    private $adresse;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string
     */
    private $ville;

    /**
     * @var boolean
     */
    private $chef_service;

    /**
     * @var \DateTime
     */
    private $date_entree;

    /**
     * @var \DateTime
     */
    private $date_sortie;

    /**
     * @var string
     */
    private $raison_sortie;

    /**
     * @var \IuchBundle\Entity\Photo
     */
    private $photo;

    /**
     * @var \IuchBundle\Entity\Fonction
     */
    private $fonction;

    /**
     * @var \IuchBundle\Entity\Service
     */
    private $service;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $services;


    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set zip
     *
     * @param string $zip
     *
     * @return User
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return User
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set chefService
     *
     * @param boolean $chefService
     *
     * @return User
     */
    public function setChefService($chefService)
    {
        $this->chef_service = $chefService;

        return $this;
    }

    /**
     * Get chefService
     *
     * @return boolean
     */
    public function getChefService()
    {
        return $this->chef_service;
    }

    /**
     * Set dateEntree
     *
     * @param \DateTime $dateEntree
     *
     * @return User
     */
    public function setDateEntree($dateEntree)
    {
        $this->date_entree = $dateEntree;

        return $this;
    }

    /**
     * Get dateEntree
     *
     * @return \DateTime
     */
    public function getDateEntree()
    {
        return $this->date_entree;
    }

    /**
     * Set dateSortie
     *
     * @param \DateTime $dateSortie
     *
     * @return User
     */
    public function setDateSortie($dateSortie)
    {
        $this->date_sortie = $dateSortie;

        return $this;
    }

    /**
     * Get dateSortie
     *
     * @return \DateTime
     */
    public function getDateSortie()
    {
        return $this->date_sortie;
    }

    /**
     * Set raisonSortie
     *
     * @param string $raisonSortie
     *
     * @return User
     */
    public function setRaisonSortie($raisonSortie)
    {
        $this->raison_sortie = $raisonSortie;

        return $this;
    }

    /**
     * Get raisonSortie
     *
     * @return string
     */
    public function getRaisonSortie()
    {
        return $this->raison_sortie;
    }

    /**
     * Set photo
     *
     * @param \IuchBundle\Entity\Photo $photo
     *
     * @return User
     */
    public function setPhoto(\IuchBundle\Entity\Photo $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \IuchBundle\Entity\Photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set fonction
     *
     * @param \IuchBundle\Entity\Fonction $fonction
     *
     * @return User
     */
    public function setFonction(\IuchBundle\Entity\Fonction $fonction = null)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return \IuchBundle\Entity\Fonction
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set service
     *
     * @param \IuchBundle\Entity\Service $service
     *
     * @return User
     */
    public function setService(\IuchBundle\Entity\Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \IuchBundle\Entity\Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Add service
     *
     * @param \IuchBundle\Entity\Service $service
     *
     * @return User
     */
    public function addService(\IuchBundle\Entity\Service $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param \IuchBundle\Entity\Service $service
     */
    public function removeService(\IuchBundle\Entity\Service $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $materiels;


    /**
     * Add materiel
     *
     * @param \IuchBundle\Entity\Materiel $materiel
     *
     * @return User
     */
    public function addMateriel(\IuchBundle\Entity\Materiel $materiel)
    {
        $this->materiels[] = $materiel;

        return $this;
    }

    /**
     * Remove materiel
     *
     * @param \IuchBundle\Entity\Materiel $materiel
     */
    public function removeMateriel(\IuchBundle\Entity\Materiel $materiel)
    {
        $this->materiels->removeElement($materiel);
    }

    /**
     * Get materiels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMateriels()
    {
        return $this->materiels;
    }
}
