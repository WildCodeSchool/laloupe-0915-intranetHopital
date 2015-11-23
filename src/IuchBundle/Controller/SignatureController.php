<?php

namespace IuchBundle\Controller;

use IuchBundle\Form\Type\SignatureType;
use Sonata\UserBundle\Model\UserInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use IuchBundle\Entity\Charte_utilisateur;
use IuchBundle\Entity\Charte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SignatureController extends Controller
{
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $chartes = $this->get('doctrine')
            ->getRepository('IuchBundle:Charte')
            ->findByService($user->getService());

        $models = array();
        foreach ($chartes as $charte)
        {
            $charte_utilisateur = $em->getRepository('IuchBundle:Charte_utilisateur')->findOneBy(array('charte' => $charte, 'user' => $user));

            $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
            $path = $helper->asset($charte, 'fichier');

            $model = new \IuchBundle\Model\Signature($charte, $charte_utilisateur);

            $model->setPath($path);

            $models[] = $model;

        }

        return $this->render('IuchBundle:Signature:index.html.twig', array(
            'chartes'=> $models,
            'user'   => $user
        ));
    }

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

            return $this->redirect($this->generateUrl('iuch_homepage'));
        }

        return $this->render('IuchBundle:Signature:signature.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
}
