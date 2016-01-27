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
                'label' => 'Utilisateur',
                'property' => array('firstname', 'lastname', 'username', 'service'),
                'minimum_input_length' => 2
            ))
            ->add('date_donnee', 'sonata_type_date_picker', array(
                'label' => 'Date de remise',
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
            ))
            ->add('nombre_donne', 'number', array(
                'label' => 'Nombre données'
            ))
            ->add('nombre_rendu', 'number', array(
                'label' => 'Nombre rendues',
                'required' => false
            ))
            ->add('commentaire', null, array(
                'required' => false
            ))
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('type')
            ->add('user', null, array(
                'label' => 'Utilisateur'
            ))
            ->add('intervenant')
            ->add('date_donnee', 'doctrine_orm_date_range', array(
                'label' => 'Date de remise',
                'field_type' => 'sonata_type_date_range_picker',
            ))
            ->add('nombre_donne', null, array(
                'label' => 'Nombre données'
            ))
            ->add('date_rendu', 'doctrine_orm_date_range', array(
                'label' => 'Date de rendu',
                'field_type' => 'sonata_type_date_range_picker',
            ))
            ->add('nombre_rendu', null, array(
                'label' => 'Nombre rendues'
            ))
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->add('type')
            ->add('user', null, array(
                'label' => 'Utilisateur',
                'route' => array(
                    'name' => 'show'
                )))
            ->add('date_donnee', 'date', array(
                'label' => 'Date de remise',
                'format'=>'d/m/Y
                '))
            ->add('nombre_donne')
            ->add('date_rendu', 'date', array(
                'label' => 'Date de rendu',
                'format'=>'d/m/Y'
            ))
            ->add('nombre_rendu', null, array(
                'label' => 'Nombre rendues'
            ))
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
            ->add('user', null, array(
                'label' => 'Utilisateur'
            ))
            ->add('type')
            ->end()
            ->with('Entrée')
            ->add('date_donnee', 'date', array(
                'label' => 'Date de remise',
                'format'=>'d/m/Y'
            ))
            ->add('nombre_donne')
            ->end()
            ->with('Sortie')
            ->add('date_rendu', 'date', array(
                'label' => 'Date de rendu',
                'format'=>'d/m/Y'
            ))
            ->add('nombre_rendu', null, array(
                'label' => 'Nombre rendues'
            ))
            ->end()
            ->with('Informations complémentaires')
            ->add('intervenant')
            ->add('commentaires')
            ->end()
        ;
    }
}
