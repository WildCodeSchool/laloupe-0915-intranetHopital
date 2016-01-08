<?php
namespace IuchBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TenueAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('type')
            ->add('user','sonata_type_model_autocomplete', array(
                'property' => array('firstname', 'lastname', 'username', 'service'),
                'minimum_input_length' => 2
            ))
            ->add('date_donnee', 'datetime')
            ->add('nombre_donne', 'number')
            ->add('nombre_rendu', 'number', array('required' => false))
            ->add('commentaire', null, array('required' => false))
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('type')
            ->add('user')
            ->add('intervenant')
            ->add('date_donnee', 'doctrine_orm_date_range')
            ->add('nombre_donne')
            ->add('date_rendu', 'doctrine_orm_date_range')
            ->add('nombre_rendu')
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->add('type')
            ->add('user', null, array(
                'route' => array(
                    'name' => 'show'
                )))
            ->add('date_donnee')
            ->add('nombre_donne')
            ->add('date_rendu')
            ->add('nombre_rendu')
            ->add('intervenant')
            ->add('commentaire')
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
            ->with('Remise')
            ->add('user')
            ->add('type')
            ->end()
            ->with('Entrée')
            ->add('date_donnee')
            ->add('nombre_donne')
            ->end()
            ->with('Sortie')
            ->add('date_rendu')
            ->add('nombre_rendu')
            ->end()
            ->with('Informations complémentaires')
            ->add('intervenant')
            ->add('commentaires')
            ->end()
        ;
    }
}
