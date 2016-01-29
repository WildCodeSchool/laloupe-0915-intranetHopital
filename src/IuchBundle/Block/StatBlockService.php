<?php
/**
 * Created by PhpStorm.
 * User: webdev33
 * Date: 02/12/15
 * Time: 10:01
 */

// src/IuchBundle/Block
namespace IuchBundle\Block;

use IuchBundle\Entity\Charte;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Admin\Pool;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;

class StatBlockService extends BaseBlockService
{
    /**
     * @var SecurityContextInterface
     */
    protected $securityContext;

    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct($name, EngineInterface $templating, Pool $pool,  EntityManager $em, SecurityContext $securityContext)
    {
        parent::__construct($name, $templating);

        $this->pool = $pool;
        $this->em = $em;
        $this->securityContext = $securityContext;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Statistiques';
    }


    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $signatures = $this->em
            ->getRepository('IuchBundle:Charte_utilisateur')
            ->findAll();

        $chartesNO = $this->em
            ->getRepository('IuchBundle:Charte')
            ->findBy(array('obligatoire' => false));

        $users = $this->em
            ->getRepository('ApplicationSonataUserBundle:User')
            ->findAll();


        $userByServices = [];
        foreach ($users as $user){
            // On recupere le service principal de chaques utilisateurs
            $userByServices[] = $user->getService()->getId();

            // Ainsi que les services secondaires
            $userServices = $user->getServices();
            foreach ($userServices as $userService){
                if (null !==($userService->getId())){
                    $userByServices[] = $userService->getId();
                };
            }
        }

        // On fait la somme des utilisateurs par service
        // Ici $sortedUserByServices = [ id_service, nb_utilisateurs ]
        // On rajoute également une entrée NULL, avec comme valeur toutes les utilisateurs dans le but de calculer les stats des chartes non rattachées au services.
        $sortedUserByServices = array_count_values($userByServices);
        $sortedUserByServices[null] = count($users);

        $signaturesByChartesNO = [];
        $percentage = [];

        foreach ($chartesNO as $charteNO) {

            // On initialise la valeur de $signaturesByChartesNO pour Toutes
            $signaturesByChartesNO['toutes'][$charteNO->getId()] = 0;

            // Si la charte est rattaché à un service, alors on va cherché l'ID du service.
            if (null !== $charteNO->getService()) {
                $servicesChartesNO['toutes'][$charteNO->getId()] = $charteNO->getService()->getId();
            }
            // Sinon on met la valeur à NULL pour 'toutes les services'
            else {
                $servicesChartesNO['toutes'][$charteNO->getId()] = null;
            }

            // On initialise notre tableau pour pouvoir récuperer les signatures sur n-5 à n années
            // On ajoute également les signatures sur toutes les années

            for ($i=date('Y'); $i > (date('Y') - 5); $i--) {
                // On initialise la valeur de $signaturesByChartesNO pour chaque années
                $signaturesByChartesNO[$i][$charteNO->getId()] = 0;

                // Si la charte est rattaché à un service, alors on va cherché l'ID du service.
                if (null !== $charteNO->getService()) {
                    $servicesChartesNO[$i][$charteNO->getId()] = $charteNO->getService()->getId();
                }
                // Sinon on met la valeur à NULL pour 'toutes les services'
                else {
                    $servicesChartesNO[$i][$charteNO->getId()] = null;
                }
            }

            foreach ($signatures as $signature) {

                $signatureYear = $signature->getDateSignature()->format('Y');
                // Pour chaques signatures par chartes on incremente $signaturesByChartesNO
                if ($charteNO == $signature->getCharte()){
                    $signaturesByChartesNO[$signatureYear][$charteNO->getId()]++;
                    $signaturesByChartesNO['toutes'][$charteNO->getId()]++;
                }
            }

            if (null !== $charteNO->getService()) {
                if (isset($sortedUserByServices[$charteNO->getService()->getId()])) {
                    // Si la charte est associé à un service, alors on calcule le pourcentage de signature
                    $signaturee = $signaturesByChartesNO['toutes'][$charteNO->getId()];
                    $maxPercentage = $sortedUserByServices[$charteNO->getService()->getId()];
                    $percentage['toutes'][$charteNO->getNom()] = $signaturee / $maxPercentage * 100;
                    $percentage['toutes'][$charteNO->getNom()] = number_format($percentage['toutes'][$charteNO->getNom()], 0, '.', '');
                    for ($i=date('Y'); $i > (date('Y') - 5); $i--){
                        $signaturee = $signaturesByChartesNO[$i][$charteNO->getId()];
                        $percentage[$i][$charteNO->getNom()] = $signaturee / $maxPercentage * 100;
                        $percentage[$i][$charteNO->getNom()] = number_format($percentage[$i][$charteNO->getNom()], 0, '.', '');
                    }
                }
            }
            else {
                // Si la charte est liée à toutes les services, alors on calcule sur la base de tous les utilisateurs
                $signaturee = $signaturesByChartesNO['toutes'][$charteNO->getId()];
                $maxPercentage = $sortedUserByServices[null];
                $percentage['toutes'][$charteNO->getNom()] = $signaturee / $maxPercentage * 100;
                $percentage['toutes'][$charteNO->getNom()] = number_format($percentage['toutes'][$charteNO->getNom()], 0, '.', '');
                for ($i=date('Y'); $i > (date('Y') - 5); $i--){
                    $signaturee = $signaturesByChartesNO[$i][$charteNO->getId()];
                    $percentage[$i][$charteNO->getNom()] = $signaturee / $maxPercentage * 100;
                    $percentage[$i][$charteNO->getNom()] = number_format($percentage[$i][$charteNO->getNom()], 0, '.', '');
                }
            }
        }

        return $this->renderResponse($blockContext->getTemplate(), array(
            'block'         => $blockContext->getBlock(),
            'base_template' => $this->pool->getTemplate('IuchBundle:Block:statistique.html.twig'),
            'settings'      => $blockContext->getSettings(),
            'bar' => $percentage,
        ), $response);
    }
    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'title'    => 'Mes informations',
            'template' => 'IuchBundle:Block:statistique.html.twig' // Le template à render dans execute()
        ));
    }

    public function getDefaultSettings()
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {

    }
}
