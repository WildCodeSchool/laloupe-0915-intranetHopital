<?php

namespace IuchBundle\Controller;

use IuchBundle\Form\Type\SignatureType;
use Symfony\Component\HttpFoundation\Request;
use IuchBundle\Entity\Charte_utilisateur;
use IuchBundle\Entity\Charte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SignatureController extends Controller
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

        return $this->render('IuchBundle:Signature:signature.html.twig', array(
            'charte' => $charte,
            'form' => $form->createView(),
        ));
    }

    private function createCreateForm(Charte_utilisateur $entity, $charte_id)
    {
        $form = $this->createForm(new SignatureType(), $entity, array(
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
            $user = $this->getUser();
            $entity->setUser($user);

            $entity->setCharte($charte_id);

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fos_user_profile_show'));
        }

        return $this->render('IuchBundle:Signature:signature.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
}