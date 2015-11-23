<?php

namespace IuchBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use IuchBundle\Entity\Charte_utilisateur;
use IuchBundle\Entity\Charte;
use IuchBundle\Form\Charte_utilisateurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends Controller
{
    public function indexAction() {
        return $this->render('IuchBundle:Signature:signature.html.twig', array(
            'charte' => $charte,
            'form' => $form->createView(),
        ));
    }
}
