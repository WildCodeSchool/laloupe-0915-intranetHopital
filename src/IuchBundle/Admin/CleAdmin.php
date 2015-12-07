<?php
namespace IuchBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class CleAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('remis')
            ->add('user','sonata_type_model_autocomplete', array(
                'property' => array('firstname', 'lastname', 'username', 'service'),
                'minimum_input_length' => 2
            ))
            ->add('date_remise', 'datetime')
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('user')
            ->add('date_remise', 'doctrine_orm_date_range')
            ->add('date_rendu', 'doctrine_orm_date_range')
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->addIdentifier('remis')
            ->add('user', null, array(
                'route' => array(
                    'name' => 'show'
                )))
            ->add('date_remise')
            ->add('date_rendu')
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
            ->with('Général')
            ->add('user')
            ->add('remis')
            ->end()
            ->with('Entrée/Sortie')
            ->add('date_remise')
            ->add('date_rendu')
            ->end()
        ;
    }
}