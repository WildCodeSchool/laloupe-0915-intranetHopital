<?php

namespace InfoMailBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfoMailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * documents represents the virtual field in the entity but it's the name of the document which is flush in the databases in $documentsNames
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', null, array(
                'label'    => 'Type d\'email',
                'required' => true,
                'choices' => array(
                    'welcome_mail' => 'mail de bienvenue',
                    'info_mail' => 'mail d\'information'
                )
            ))
            ->add('subject')
            ->add('body', CKEditorType::class, array(
                'config_name' => 'my_config'))
            ->add('uploadedFiles', FileType::class, array(
                'required' => false,
                'multiple' => true,
                'data_class' => null,)
            )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InfoMailBundle\Entity\InfoMail'
        ));
    }
}
