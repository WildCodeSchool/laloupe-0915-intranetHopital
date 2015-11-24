<?php

namespace IuchBundle\Controller;

use IuchBundle\Form\Type\SignatureType;
use Sonata\UserBundle\Model\UserInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use IuchBundle\Entity\Charte_utilisateur;
use IuchBundle\Entity\Charte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SignatureController extends Controller
{
    /**
     * Retourne la liste des chartes correspondant à l'utilisateur loggé et si il les a signé ou pas.
     * Il peut aussi les cocher pour signifier qu'il les signe
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
            ->findByService($user->getService());

        $models = array();
        foreach ($chartes as $charte)
        {
            $charte_utilisateur = $em->getRepository('IuchBundle:Charte_utilisateur')->findOneBy(array('charte' => $charte, 'user' => $user));

            $model = new \IuchBundle\Model\Signature($charte, $charte_utilisateur);

            $models[] = $model;
        }

        return $this->render('IuchBundle:Signature:index.html.twig', array(
            'chartes'=> $models,
            'user'   => $user
        ));
    }

    /**
     * Affiche le pdf embedded et une checkbox de signature
     *
     * @param $charte_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function signatureAction($charte_id)
    {
        $em = $this->getDoctrine()->getManager();

        if (!$this->getUser())
        {
            return $this->redirectToRoute('fos_user_security_login');
        }

        $charte = $this->get('doctrine')
            ->getRepository('IuchBundle:Charte')
            ->findOneById($charte_id);

        if (!$charte) {
            throw $this->createNotFoundException('Unable to find Charte entity.');
        }

        $user = $this->getUser();

        $charte_utilisateur = $em->getRepository('IuchBundle:Charte_utilisateur')->findOneBy(array('charte' => $charte, 'user' => $user));

        if ($charte_utilisateur == null) {

            $entity = new Charte_utilisateur();
            $form = $this->createCreateForm($entity, $charte_id);

            return $this->render('IuchBundle:Signature:signature.html.twig', array(
                'charte' => $charte,
                'form' => $form->createView()
            ));
        }
        else {
            $this->addFlash(
                'notice',
                'Déjà signé !'
            );

            return $this->redirectToRoute('iuch_homepage');
        }
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

    /**
     * Ajoute une nouvelle signature sur une charte
     *
     * @param Request $request
     * @param Charte $charte_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
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

    /**
     * Récupère le fichier de charte (pdf) en vérifiant les autorisations
     *
     * @param $charte_name
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function getCharteAction($charte_name)
    {
        if (!$this->getUser())
        {
            return $this->redirectToRoute('fos_user_security_login');
        }

        // Generate response
        $response = new Response();

        // Set headers
        $filepath = $this->get('kernel')->getRootDir()."/uploads/".$charte_name;
        $charteFile = new File($filepath);
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', $charteFile->getMimeType());
        $response->headers->set('Content-Disposition', 'inline; filepath="' . $charteFile->getBasename() . '";');
        $response->headers->set('Content-length', $charteFile->getSize());

        // Send headers before outputting anything
        $response->sendHeaders();

        $response->setContent(file_get_contents($filepath));

        return $response;
    }
}
