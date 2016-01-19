<?php
namespace InfoMailBundle\Admin;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class InfoMailAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
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
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('type')
            ->add('subject')
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('subject')
            ->add('type')
            ->add('files')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'show' => array(),
                    'delete' => array()
                )
            ))
        ;
    }
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('type')
            ->add('subject')
            ->add('body')
            ->add('files')
        ;
    }
}
