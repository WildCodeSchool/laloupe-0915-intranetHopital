<?php

namespace InfoMailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * File
 */
class File
{
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @param UploadedFile $uploadedFile
     */
    function __construct(UploadedFile $uploadedFile)
    {
        $cleanFilename = preg_replace("/[^A-Za-z0-9\\.]/", "-", ucwords(strtolower($uploadedFile->getClientOriginalName())));
        $path = uniqid().'-'.$cleanFilename;
        $this->setPath($path);
        $this->setSize($uploadedFile->getClientSize());
        $this->setName($cleanFilename);
        $uploadedFile->move($this->getUploadRootDir(), $path);
    }

    /**
     * @return string
     */
    public function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }
    /**
     * @return string
     */
    protected function getUploadDir()
    {
        return 'uploads/infoMails';
    }
    /**
     * @ORM\PostRemove()
     */
    public function removeFile()
    {
        if ($file = $this->getUploadRootDir().'/'.$this->path) {
            unlink($file);
        }
    }

    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }
    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    // GENERATED CODE
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $size;

    /**
     * @var \InfoMailBundle\Entity\InfoMail
     */
    private $infoMail;


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
     * Set path
     *
     * @param string $path
     *
     * @return File
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return File
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set size
     *
     * @param integer $size
     *
     * @return File
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }


    /**
     * Set infoMail
     *
     * @param \InfoMailBundle\Entity\InfoMail $infoMail
     *
     * @return File
     */
    public function setInfoMail(\InfoMailBundle\Entity\InfoMail $infoMail = null)
    {
        $this->infoMail = $infoMail;

        return $this;
    }

    /**
     * Get document
     *
     * @return \InfoMailBundle\Entity\InfoMail
     */
    public function getDocument()
    {
        return $this->infoMail;
    }

    /**
     * Get infoMail
     *
     * @return \InfoMailBundle\Entity\InfoMail
     */
    public function getInfoMail()
    {
        return $this->infoMail;
    }
}
