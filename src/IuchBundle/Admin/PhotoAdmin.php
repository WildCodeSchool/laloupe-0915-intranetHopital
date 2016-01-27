<?php
namespace IuchBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PhotoAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        if ($this->id($this->getSubject())) {
            // EDIT
            $formMapper
                ->add('photo_file', 'file')
            ;
        }
        else {
            // CREATE
            $formMapper
                ->add('photo_file', 'file')
                ->add('user', 'sonata_type_model', array('btn_add'=>false,'query'=> $this->modelManager->getEntityManager('ApplicationSonataUserBundle:User')->createQueryBuilder()
                    ->select('u')
                    ->from('ApplicationSonataUserBundle:User','u')// Dans un repository, $this->_entityName est le namespace de l'entité gérée
                    ->Where('u.photo is null')
                    ->andWhere('u.enabled = true')
                ))
            ;
        }
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('user', null, array(
                'label' => 'Utilisateur'
            ))
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('photo_file','image', array(
                'template' => 'IuchBundle:Photo:photo.html.twig'
            ))
            ->add('user', null, array(
                'label'=>'Utilisateur'
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
            ->add('user', null, array(
                'label'=>'Utilisateur'
            ))
            ->add('photo_file')
        ;
    }
}
