<?php
namespace IuchBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class MaterielAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('type', null, array(
                'required' => true
            ))
            ->add('user','sonata_type_model_autocomplete', array(
                'label' => 'Utilisateur',
                'property' => array(
                    'firstname', 'lastname', 'username', 'service'),
                'minimum_input_length' => 2
            ))
            ->add('date_remise', 'sonata_type_date_picker', array(
                'label' => 'Date de remise',
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'required' => false,
                ))
            ->add('rendu', null, array(
                'label'=>'Rendu (validé à date du jour)'
            ))
            ->add('perdu_vol', null, array(
                'label'=>'Perdu/volé'
            ))
            ->add('commentaire', null, array(
                'required' => false
            ))
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('user', null, array(
                'label' => 'Utilisateur'
            ))
            ->add('type')
            ->add('date_remise', 'doctrine_orm_date_range', array(
                'label' => 'Date de remise',
                'field_type' => 'sonata_type_date_range_picker',
            ))
            ->add('rendu', null, array(
                'label' => 'Rendu'
            ))
            ->add('perdu_vol', null, array(
                'label'=>'perdu/volé'
            ))
            ->add('date_rendu', 'doctrine_orm_date_range', array(
                'label' => 'Date de rendu',
                'field_type' => 'sonata_type_date_range_picker',
            ))
            ->add('intervenant')
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->add('rendu', null, array(
                'label' => 'Rendu'
            ))
            ->add('perdu_vol', null, array(
                'label' => 'Perdu/Volé'
            ))
            ->add('type')
            ->add('user', null, array(
                'label' => 'Utilisateur',
                'route' => array(
                    'name' => 'show'
                )))
            ->add('date_remise', 'date', array(
                'label' => 'Date de remise',
                'format'=>'d/m/Y'
            ))
            ->add('date_rendu', 'date', array(
                'label' => 'Date de rendu',
                'format'=>'d/m/Y'
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
            ->with('Général')
            ->add('user', null, array(
                'label' => 'Utilisateur'
            ))
            ->add('rendu', null, array(
                'label' => 'Rendu'
            ))
            ->add('perdu_vol', null, array(
                'label'=>'Perdu/volé'
            ))
            ->add('type')
            ->end()
            ->with('Entrée/Sortie')
            ->add('date_remise', 'date', array(
                'label' => 'Date de remise',
                'format'=>'d/m/Y'
            ))
            ->add('date_rendu', 'date', array(
                'label' => 'Date de rendu',
                'format'=>'d/m/Y'
            ))
            ->end()
            ->with('Informations complémentaires')
            ->add('intervenant')
            ->add('commentaire')
            ->end()
        ;
    }
}
