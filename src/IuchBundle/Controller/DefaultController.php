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
    public function signatureAction($charte_id)
    {
        $charte = $this->get('doctrine')
            ->getRepository('IuchBundle:Charte')
            ->findOneById($charte_id);

        if (!$charte) {
            throw $this->createNotFoundException('Unable to find Charte entity.');
        }

        $entity = new Charte_utilisateur();
        $form   = $this->createCreateForm($entity, $charte_id);

        return $this->render('IuchBundle:Default:signature.html.twig', array(
            'charte' => $charte,
            'form' => $form->createView(),
        ));
    }

    private function createCreateForm(Charte_utilisateur $entity, $charte_id)
    {
        $form = $this->createForm(new Charte_utilisateurType(), $entity, array(
            'action' => $this->generateUrl('iuch_create_signature', array('charte_id' => $charte_id)),
            'method' => 'POST'
        ));

        $form->add('submit', 'submit', array('label' => 'Signer'));

        return $form;
    }

    public function createSignatureAction(Request $request, Charte $charte_id)
    {
        $entity = new Charte_utilisateur();
        $form   = $this->createCreateForm($entity, $charte_id);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entity->setDateSignature(new \DateTime('now'));
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $entity->setUser($user);

            $entity->setCharte($charte_id);

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sonata_user_profile_edit', array('id' => $entity->getId())));
        }

        return $this->render('IuchBundle:Default:signature.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
}
