<?php

namespace IuchBundle\Entity;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Fichier
 */
class Charte
{

    /**
     * https://github.com/K-Phoen/Vich-Uploader-Sandbox/tree/master/src/KPhoen/Bundle/SingleUploadableBundle
     */

    /**
     * @var File $image
     */
    protected $fichier;
    public function __toString()
    {
        return $this->title ? $this->title : '';
    }

    public function setFichier(File $fichier)
    {
        $this->fichier = $fichier;
        return $this;
    }
    public function getFichier()
    {
        return $this->fichier;
    }

    // GENERATED CODE
    /**
     * @var integer
     */
    protected $id;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string
     */
    protected $file_name;
    /**
     * @var string
     */
    private $nom;
    /**
     * @var string
     */
    private $description;

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
     * Set file_name
     *
     * @param string $fileName
     * @return Charte
     */
    public function setFileName($fileName)
    {
        $this->file_name = $fileName;
        return $this;
    }
    /**
     * Get file_name
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Charte
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Charte
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
}
