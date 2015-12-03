<?php
namespace IuchBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class PhotoAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('photo', 'file')
            ->add('user')
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('user')
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->addIdentifier('photo')
            ->add('user', 'entity', array('label'=>'Utilisateur'))
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
            ->add('user')
            ->add('photo')
        ;
    }
}