<?php
// src/Application/Sonata/UserBundle/Form/Type/ProfileType.php

namespace Application\Sonata\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\UserBundle\Model\UserInterface;

class ProfileType extends \Sonata\UserBundle\Form\Type\ProfileType
{
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', 'sonata_user_gender', array(
                'label'    => 'form.label_gender',
                'required' => true,
                'translation_domain' => 'SonataUserBundle',
                'choices' => array(
                    UserInterface::GENDER_FEMALE => 'gender_female',
                    UserInterface::GENDER_MALE   => 'gender_male',
                )
            ))
            ->add('firstname', null, array(
                'label'    => 'form.label_firstname',
                'required' => false
            ))
            ->add('lastname', null, array(
                'label'    => 'form.label_lastname',
                'required' => false
            ))
            ->add('dateOfBirth', 'birthday', array(
                'label'    => 'form.label_date_of_birth',
                'required' => false,
                'widget'   => 'single_text'
            ))
            ->add('phone', null, array(
                'label'    => 'form.label_phone',
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
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'application_sonata_user_profile';
    }
}
