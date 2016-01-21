<?php

namespace InfoMailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Mapping\ClassMetadata;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * InfoMail
 */
class InfoMail
{

    public function __construct() {
        $this->files = new ArrayCollection();
        $this->uploadedFiles = new ArrayCollection();
    }

    /**
     * Check if the size of the documents are not to big for a mail
     *
     * @param ExecutionContextInterface $context
     *
     */
    public function validate(ExecutionContextInterface $context)
    {
        if ( $this->uploadedFiles != null ) {
            $totalUploadedFiles = 0;
            $totalFiles = 0;
            foreach ($this->uploadedFiles as $uploadedFile) {
                if ($uploadedFile) {
                    $totalUploadedFiles += $uploadedFile->getSize();
                }
            }

            foreach($this->files as $file) {
                if ($file) {
                    $totalFiles += $file->getSize();
                }
            }

            if ( ($totalUploadedFiles + $totalFiles) >= 20971520 ) {
                $context->buildViolation('Les pièces jointes sont trop lourdes.')
                    ->atPath('uploadedFiles')
                    ->addViolation();
            }
        }
    }

    /**
     * @ORM\PreFlush()
     */
    public function upload()
    {
        if ( $this->uploadedFiles != null ) {

            foreach ($this->uploadedFiles as $uploadedFile) {
                if ($uploadedFile) {

                    $file = new File($uploadedFile);
                    $this->getFiles()->add($file);
                    $file->setInfoMail($this);
                    unset($uploadedFile);
                }
            }
        }
    }

    /**
     * Remove file
     *
     * @param \InfoMailBundle\Entity\File $file
     */
    public function removeFile(\InfoMailBundle\Entity\File $file)
    {
        $this->files->removeElement($file);
        $file->setInfoMail(null);
    }


    /**
     * @var ArrayCollection
     */
    private $uploadedFiles;

    /**
     * @return ArrayCollection
     */
    public function getUploadedFiles()
    {
        return $this->uploadedFiles;
    }
    /**
     * @param ArrayCollection $uploadedFiles
     */
    public function setUploadedFiles($uploadedFiles)
    {
        $this->uploadedFiles = $uploadedFiles;
    }

    // GENERATED  CODE
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $body;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $files;

    /**
     * @var string
     */
    private $type;

    /**
     * @var \DateTime
     */
    private $date_last_send;

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
     * Set subject
     *
     * @param string $subject
     *
     * @return InfoMail
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return InfoMail
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Add file
     *
     * @param \InfoMailBundle\Entity\File $file
     *
     * @return InfoMail
     */
    public function addFile(\InfoMailBundle\Entity\File $file)
    {
        $this->files[] = $file;

        return $this;
    }

    /**
     * Get files
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return InfoMail
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set date_last_send
     *
     * @param \DateTime $date_last_send
     *
     * @return InfoMail
     */
    public function setDateLastSend($date_last_send)
    {
        $this->date_last_send = $date_last_send;

        return $this;
    }

    /**
     * Get dateLastSend
     *
     * @return \DateTime
     */
    public function getDateLastSend()
    {
        return $this->date_last_send;
    }
}
