<?php
// src/Application/Sonata/UserBundle/Form/Type/ProfileType.php

namespace Application\Sonata\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
