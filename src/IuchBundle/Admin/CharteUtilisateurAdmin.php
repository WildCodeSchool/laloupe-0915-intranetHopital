<?php
namespace IuchBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class CharteUtilisateurAdmin extends Admin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('charte')
            ->add('user', null, array(
                'label' => 'Utilisateur'))
            ->add('dateSignature', null, array(
                'label' => 'Date de signature'
            ))
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('charte', null, array(
                'route' => array(
                    'name' => 'show'
                )))
            ->addIdentifier('user', null, array(
                'label' => 'Utilisateur',
                'route' => array(
                    'name' => 'show'
                )))
            ->add('dateSignature', null, array(
                'label' => 'Date de signature'
            ))
            ->add('charte.obligatoire')
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
            ->with('General')
            ->add('charte')
            ->add('user', null, array(
                'label' => 'Utilisateur'
            ))
            ->add('dateSignature', null, array(
                'label' => 'Date de signature'
            ))
            ->end()
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ->remove('edit')
        ;
    }
}
