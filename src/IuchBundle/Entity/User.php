<?php

namespace IuchBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;


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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $chartes;


    /**
     * Add charte
     *
     * @param \IuchBundle\Entity\Charte $charte
     *
     * @return User
     */
    public function addCharte(\IuchBundle\Entity\Charte $charte)
    {
        $this->chartes[] = $charte;

        return $this;
    }

    /**
     * Remove charte
     *
     * @param \IuchBundle\Entity\Charte $charte
     */
    public function removeCharte(\IuchBundle\Entity\Charte $charte)
    {
        $this->chartes->removeElement($charte);
    }

    /**
     * Get chartes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChartes()
    {
        return $this->chartes;
    }
}
