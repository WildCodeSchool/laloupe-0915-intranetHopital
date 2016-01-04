<?php
/**
 * Created by PhpStorm.
 * User: webdev33
 * Date: 02/12/15
 * Time: 10:01
 */

// src/IuchBundle/Block
namespace IuchBundle\Block;

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

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

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
        $user_current   = $this->securityContext->getToken()->getUser();
        $user_id = $user_current->getId();

        $signatures = $this->em
            ->getRepository('IuchBundle:Charte_utilisateur')
            ->findAll();

        $users = $this->em
            ->getRepository('ApplicationSonataUserBundle:User')
            ->findAll();

        $chartesSignees = [];

        foreach ($signatures as $signature) {
            $charte = $signature->getCharte();
            $chartesSignees[] = $charte;
        }

        $map = function($charte) {
            return substr($charte->getNom(), 6, 20).'...';
        };

        $nbSignaturesByCharte = array_count_values(array_map($map, $chartesSignees));

        $labels = [];
        $datas = [];

        foreach ($nbSignaturesByCharte as $charte => $nbSignature)
        {
            $labels[] = $charte;
            $datas[] = $nbSignature;
        }

        $datasBar = array(
            'labels' => array($labels),
            'datasets' => array(
                array(
                    'label' => 'Signées',
                    'fillColor'=> "rgba(220,220,220,0.5)",
                    'strokeColor'=> "rgba(220,220,220,0.8)",
                    'highlightFill'=> "rgba(220,220,220,0.75)",
                    'highlightStroke'=> "rgba(220,220,220,1)",
                    'data' => $datas
                )
            )
        );

        $settings = array_merge($this->getDefaultSettings(), $blockContext->getSettings());

        return $this->renderResponse($blockContext->getTemplate(), array(
            'block'         => $blockContext->getBlock(),
            'base_template' => $this->pool->getTemplate('IuchBundle:Block:statistique.html.twig'),
            'settings'      => $blockContext->getSettings(),
            'bar' => $nbSignaturesByCharte

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
