<?php

namespace IuchBundle\Entity;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Photo
 */
class Photo
{
    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @var File $file
     */
    public $photo_file;

    protected function getUploadDir()
    {
        return 'uploads/photos';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../app/'.$this->getUploadDir();
    }

    public function getAbsolutePath()
    {
        return null === $this->nom ? null : $this->getUploadRootDir().'/'.$this->nom;
    }

    public function preUpload()
    {
        if (null !== $this->photo_file) {
            // do whatever you want to generate a unique name
            $this->nom = $this->getUser()->getUsername().'.'.$this->photo_file->guessExtension();
        }
    }

    public function upload()
    {
        if (null === $this->photo_file) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->photo_file->move($this->getUploadRootDir(), $this->nom);

        unset($this->photo_file);
    }

    public function removeUpload()
    {
        if ($photo_file = $this->getAbsolutePath()) {
            unlink($photo_file);
        }
    }

    // GENERATED CODE

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $user;


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
     * @return Photo
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
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     *
     * @return Photo
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
