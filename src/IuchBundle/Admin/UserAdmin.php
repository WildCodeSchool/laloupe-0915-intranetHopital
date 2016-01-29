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
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

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
            ->addIdentifier('photo', null, array('label'=>'Photo', 'template' => 'IuchBundle:Photo:photo.html.twig'))
            ->addIdentifier('username', null, array(
                'label' => 'Matricule',
            ))
            ->add('lastname')
            ->add('firstname')
            ->add('service.nom', null, array(
                'label' => 'Service référent'
            ))
            ->add('chef_service', 'boolean', array(
                'label' => 'Chef de service',
                'template' => 'IuchBundle:ChefService:list_link.html.twig'
            ))
            ->add('fonction.nom', null, array(
                'label' => 'Fonction',
            ))
            ->add('enabled', null, array('editable' => true))
            ->add('_action', 'actions', array(
                'label' => 'Actions',
                'actions' => array(
                    'edit' => array(),
                    'show' => array(),
                    'delete' => array(),
                    'reset' => array(
                        'template' => 'ApplicationSonataUserBundle::list__action_reset.html.twig'
                    )
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
            ->add('service', null, array(
                'label' => 'Service'
            ), null, array('multiple' => true))
            ->add('fonction', null, array(
                'label'=> 'Fonction'
            ), null, array('multiple' => true))
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
            ->add('gender')
            ->add('firstname')
            ->add('lastname')
            ->add('dateOfBirth', 'date', array('format'=>'d/m/Y'))
            ->end()
            ->with('Contact')
            ->add('phone')
            ->add('email', 'email')
            ->add('adresse', null, array('label' => 'Adresse'))
            ->add('zip', null, array('label' => 'Code postal'))
            ->add('ville', null, array('label' => 'Ville'))
            ->end()
            ->with('Informations internes')
            ->add('fonction', null, array('label' => 'Fonction'))
            ->add('service', null, array('label' => 'Service référent'))
            ->add('chef_service', 'boolean', array('label' => 'Chef de service'))
            ->add('services', null, array('label' => 'Services secondaire'))
            ->add('date_entree', 'date', array(
                'label' => 'Date entrée',
                'format'=>'d/m/Y'))
            ->add('date_sortie', 'date', array(
                'label' => 'Date sortie',
                'format'=>'d/m/Y'))
            ->add('raison_sortie', null, array('label' => 'Raison de sortie'))
            ->add('code_copieur', null, array('label' => 'Code copieur'))
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Informations obligatoires')
            ->add('username', null, array(
                'label' => 'Matricule',
                'attr' => array('maxlength' => '6'),
                'required' => true,
                'error_bubbling' => true
            ))
            ->add('lastname', null, array('required' => true))
            ->add('firstname', null, array('required' => true))
            ->add('gender', 'sonata_user_gender', array(
                'translation_domain' => $this->getTranslationDomain()
            ))
            ->add('dateOfBirth', 'sonata_type_date_picker', array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
            ))
            ->add('enabled', null, array(
                'required' => false
            ))
            ->end()
            ->with('Fonction & service')
            ->add('fonction', 'sonata_type_model_list', array(
                'label' => 'Fonction',
                'required' => true,
                'error_bubbling' => true
            ))
            ->add('service', 'sonata_type_model_list', array(
                'label' => 'Service référent',
                'required' => true,
                'error_bubbling' => true
            ))
            ->add('services', null, array(
                'required' => false,
                'expanded' => true,
                'multiple' => true,
                'label' => 'Services secondaires'
            ))
            ->end()
            ->with('Dates arrivée & départ')
            ->add('date_entree', 'sonata_type_date_picker', array(
                'label' => 'Date d\'entrée',
                'placeholder' => '',
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'required' => true,
            ))
            ->add('date_sortie', 'sonata_type_date_picker', array(
                'label' => 'Date de sortie',
                'placeholder' => '',
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'required' => false
            ))
            ->add('raison_sortie', 'choice', array(
                'choices' => array('' => '', 'MATERNITE' => 'MATERNITE', 'RETRAITE' => 'RETRAITE', 'ARRET MALADIE' => 'ARRET MALADIE', 'FIN DE CONTRAT' => 'FIN DE CONTRAT'),
                'label' => 'Raison de sortie',
                'required' => false
            ))
            ->end()
            ->with('Contact')
            ->add('email', null, array('required' => false))
            ->add('phone', null, array('required' => false))
            ->add('adresse', null, array(
                'label' => 'Adresse'
            ))
            ->add('zip', null, array(
                'label' => 'Code postal',
                'attr' => array('maxlength' => '5')
            ))
            ->add('ville', null, array(
                'label' => 'Ville'
            ))
            ->end()
            ->end();

        $roles = array(
            'ROLE_SONATA_USER_ADMIN_USER_ADMIN' => 'Utilisateurs',
            'ROLE_SONATA_CHARTE_ADMIN' => 'Chartes',
            'ROLE_SONATA_TYPE_ADMIN' => 'Type tenu et materiel',
            'ROLE_SONATA_TENUE_ADMIN' => 'Tenues',
            'ROLE_SONATA_MATERIEL_ADMIN' => 'Materiel',
            'ROLE_SONATA_PHOTO_ADMIN' => 'Photos',
            'ROLE_SONATA_INFOMAIL_ADMIN' => 'Infomails',
            'ROLE_STATS_CHARTES' => 'Statistiques chartes'
        );

        // ['Utilisateurs', 'Fonctions', 'Services', 'Chartes', 'Tenues', 'Matériels', 'Infomails', 'Photos'];

        if ($this->getSubject() && !$this->getSubject()->hasRole('ROLE_ADMIN') || !$this->getSubject()->hasRole('ROLE_RH')) {
            $formMapper
                ->with('Permissions')
                ->add('Roles', 'choice', [
                    'label' => 'Accès à la gestion de :',
                    'choices' => $roles,
                    'multiple' => true,
                    'expanded' => true,
                    'required' => false
                ])
                ->end();

        }
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

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('reset', $this->getRouterIdParameter() . '/reset');
    }

    # Override to add actions like delete, etc...
    public function getBatchActions()
    {
        // retrieve the default (currently only the delete action) actions
        $actions = parent::getBatchActions();

        // check user permissions
        if($this->hasRoute('edit') && $this->isGranted('EDIT') && $this->hasRoute('delete') && $this->isGranted('DELETE'))
        {
            // define calculate action
            $actions['reset']= array ('label' => 'Réinitialiser mdp', 'ask_confirmation'  => true );

        }

        return $actions;
    }
}
