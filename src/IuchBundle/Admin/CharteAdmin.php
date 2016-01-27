<?php
namespace IuchBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CharteAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nom')
            ->add('description', 'textarea', array('required' => false))
            ->add('file', 'file', array('label' => 'Charte', 'required' => false))
            ->add('service', null, array('placeholder'=> 'Tous services', 'required' => false))
            ->add('obligatoire')
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom')
            ->add('service')
            ->add('obligatoire', 'doctrine_orm_choice', array(), 'choice' , array(
                'choices' => array('1' => 'oui', '0' => 'non'),
                'expanded'=> true,
                'multiple'=> false
            ));
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('charte', 'string', array('template' => 'IuchBundle:Charte:list_link.html.twig'))
            ->add('service')
            ->add('obligatoire')
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
            ->add('nom')
            ->add('description')
            ->add('charte', 'string', array(
                'template' => 'IuchBundle:Charte:show.html.twig'
            ))
            ->add('service')
            ->add('obligatoire')
            ->end()
        ;
    }
}
