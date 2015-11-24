<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IuchBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\UserBundle\Model\UserInterface;

use FOS\UserBundle\Model\UserManagerInterface;

class UserAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    public function getFormBuilder()
    {
        $this->formOptions['data_class'] = $this->getClass();

        $options = $this->formOptions;
        $options['validation_groups'] = (!$this->getSubject() || is_null($this->getSubject()->getId())) ? 'Own' : 'UserValidation';

        $formBuilder = $this->getFormContractor()->getFormBuilder( $this->getUniqid(), $options);

        $this->defineFormBuilder($formBuilder);

        return $formBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function getExportFields()
    {
        // avoid security field to be exported
        return array_filter(parent::getExportFields(), function($v) {
            return !in_array($v, array('password', 'salt'));
        });
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username', null, array(
                'label' => 'Matricule',
            ))
            ->add('lastname')
            ->add('firstname')
            ->add('service.nom', null, array(
                'label' => 'Service',
            ))
            ->add('chef_service', null, array(
                'label' => 'Chef de service',
            ))
            ->add('fonction.nom', null, array(
                'label' => 'Fonction',
            ))
            ->add('date_entree', null, array(
                'label' => 'Date d\'entrée',
                'format' => 'd/m/Y',
                'timezone' => 'Europe/Paris'
            ))
            ->add('date_sortie', null, array(
                'label' => 'Date de sortie',
                'format' => 'd/m/Y',
                'timezone' => 'Europe/Paris'
            ))
            ->add('_action', 'actions', array(
                'label' => 'Actions',
                'actions' => array(
                    'edit' => array(),
                    'show' => array(),
                    'delete' => array()
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('username', null, array(
                'label' => 'Matricule',
            ))
            ->add('firstname')
            ->add('lastname')
            ->add('service.nom', null, array(
                'label' => 'Service',
            ))
            ->add('fonction.nom', null, array(
                'label' => 'Fonction',
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
                ->add('username')
                ->add('email')
            ->end()
            ->with('Profile')
                ->add('dateOfBirth')
                ->add('firstname')
                ->add('lastname')
                ->add('website')
                ->add('biography')
                ->add('gender')
                ->add('locale')
                ->add('timezone')
                ->add('phone')
            ->end()
            ->with('Security')
                ->add('token')
                ->add('twoStepVerificationCode')
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Informations Obligatoires')
                ->add('username', null, array(
                    'label' => 'Matricule',
                    'required' => true
                ))
                ->add('lastname', null, array('required' => true))
                ->add('firstname', null, array('required' => true))
                ->add('gender', 'sonata_user_gender', array(
                    'translation_domain' => $this->getTranslationDomain()
                ))
                ->add('dateOfBirth', 'birthday')
                ->add('adresse', null, array(
                    'label' => 'Adresse',
                    'required' => true
                ))
                ->add('zip', null, array(
                    'label' => 'Code postal',
                    'required' => true
                ))
                ->add('ville' , null, array(
                    'label' => 'Ville',
                    'required' => true
                ))
            ->end()
            ->with('Contact')
                ->add('phone', null, array('required' => false))
                ->add('email', null, array('required' => false))
            ->end()
            ->with('Informations internes')
                ->add('date_entree', null, array(
                    'label' => 'Date d\'entrée'
                ))
                ->add('date_sortie', null, array(
                    'label' => 'Date de sortie'
                ))
                ->add('raison_sortie', null, array(
                    'label' => 'Raison de la sortie'
                ))
                ->add('fonction', null, array(
                    'label' => 'Fonction'
                ))
                ->add('service', null, array(
                    'label' => 'Service'
                ))
                ->add('chef_service', null, array(
                    'label' => 'Chef de service'
                ))
            ->end()
        ;

    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($user)
    {
        $this->getUserManager()->updateCanonicalFields($user);
        $this->getUserManager()->updatePassword($user);
    }

    /**
     * @param UserManagerInterface $userManager
     */
    public function setUserManager(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @return UserManagerInterface
     */
    public function getUserManager()
    {
        return $this->userManager;
    }
}
