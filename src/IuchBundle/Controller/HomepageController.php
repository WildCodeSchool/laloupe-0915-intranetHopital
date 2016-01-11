<?php

namespace IuchBundle\Controller;

use Sonata\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends Controller
{
    /**
     * Retourne la liste des chartes correspondant à l'utilisateur loggé et si il les a signé ou pas.
     * Retourne la gestion des tenues
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            return $this->redirect($this->generateUrl('sonata_user_security_login'));
        }

        $chartes = $this->get('doctrine')
            ->getRepository('IuchBundle:Charte')
            ->findByServices($user->getService(), $user->getServices());

        $models = array();
        foreach ($chartes as $charte)
        {
            $charte_utilisateur = $em->getRepository('IuchBundle:Charte_utilisateur')->findOneBy(array('charte' => $charte, 'user' => $user));

            $model = new \IuchBundle\Model\Signature($charte, $charte_utilisateur);

            $models[] = $model;
        }

        $tenues = $this->get('doctrine')
            ->getRepository('IuchBundle:Tenue')
            ->findByUser($user);

        $materiels = $this->get('doctrine')
            ->getRepository('IuchBundle:Materiel')
            ->findByUser($user);

        return $this->render('IuchBundle::index.html.twig', array(
            'tenues'=> $tenues,
            'materiels'=> $materiels,
            'chartes'=> $models,
            'user'   => $user
        ));
    }
}
