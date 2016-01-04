<?php

namespace IuchBundle\Filter;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;
use Symfony\Bundle\TwigBundle\TwigEngine;

/**
 * @author Baptiste Donaux <baptiste.donaux@gmail.com>
 */
class TwigFilter implements FilterInterface
{
    private $templating;

    public function __construct(TwigEngine $templating)
    {
        $this->templating = $templating;
    }

    public function filterLoad(AssetInterface $asset)
    {}

    public function filterDump(AssetInterface $asset)
    {
        $content = $asset->getContent();
        $content = $this->templating->render($asset->getSourceRoot()."/".$asset->getSourcePath());

        $asset->setContent($content);
    }
}
