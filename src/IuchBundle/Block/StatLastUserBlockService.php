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

class StatLastUserBlockService extends BaseBlockService
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
        return 'Utilisateurs';
    }


    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {

        $last_users = $this->em
            ->getRepository('ApplicationSonataUserBundle:User')
            ->lastUsersMonth();


        return $this->renderResponse($blockContext->getTemplate(), array(
            'block'         => $blockContext->getBlock(),
            'base_template' => $this->pool->getTemplate('IuchBundle:Block:statlastuser.html.twig'),
            'settings'      => $blockContext->getSettings(),
            'lastUsers'        => $last_users,
        ), $response);
    }
    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'title'    => 'Mes informations',
            'template' => 'IuchBundle:Block:statlastuser.html.twig' // Le template à render dans execute()
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
