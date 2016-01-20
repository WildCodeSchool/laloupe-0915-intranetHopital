<?php
namespace InfoMailBunlde\Service;

use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

class AdminValidationService extends BaseBlockService
{
    public function AdminValidationService(ErrorElement $errorElement, BlockInterface $block)
    {
        $errorElement
            ->with('actif', 'type')
                ->addConstraint(new Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity)
            ->end();
    }
}