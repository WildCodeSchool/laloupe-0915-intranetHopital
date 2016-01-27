<?php
namespace IuchBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ServiceAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('uf')
            ->add('nom')
            ->add('email')
            ->add('telephone', null, array(
                'help' => 'Exemple : 0123456789 | 01 23 45 67 89 | 01-23-45-67-89 | 01.23.45.67.89'
            ))
            ->add('chef_service', null, array('placeholder'=>'Choisissez un chef de service', 'label'=>'Chef de service'))
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom')
            ->add('chef_service', null, array(
                'label' => 'Chef de service'
            ))
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->addIdentifier('uf')
            ->add('nom')
            ->add('email')
            ->add('telephone')
            ->add('chef_service', null, array(
                'label' => 'Chef de service'
            ))
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
            ->add('uf')
            ->add('nom')
            ->add('email')
            ->add('telephone')
            ->add('chef_service', null, array(
                'label' => 'Chef de service'
            ))
            ->end()
        ;
    }
}
