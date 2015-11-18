<?php

namespace IuchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('IuchBundle:Default:index.html.twig');
    }
}
