<?php
// src/Application/Sonata/UserBundle/Form/Type/ProfileType.php

namespace Application\Sonata\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\UserBundle\Model\UserInterface;

class ProfileType extends \Sonata\UserBundle\Form\Type\ProfileType
{
    /**
     * @param string $class The User class name
     */
    public function __construct()
    {
        parent::__construct('Application\Sonata\UserBundle\Entity\User');
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('phone', null, array(
                'label'    => 'form.label_phone',
                'attr' => array('maxlength' => '10'),
                'required' => false
            ))
            ->add('email', null, array(
                'label'    => 'form.label_email',
                'required' => false
            ))
            ->add('adresse', null, array(
                'required' => false
            ))
            ->add('zip', null, array(
                'label'    => 'Code postal',
                'required' => false
            ))
            ->add('ville', null, array(
                'required' => false
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'application_sonata_user_profile';
    }
}
