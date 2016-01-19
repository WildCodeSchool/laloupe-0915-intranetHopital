<?php

namespace InfoMailBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use InfoMailBundle\Entity\InfoMail;
use InfoMailBundle\Form\InfoMailType;

/**
 * InfoMail controller.
 *
 */
class InfoMailController extends Controller
{
    /**
     * Lists all InfoMail entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $infoMails = $em->getRepository('InfoMailBundle:InfoMail')->findAll();

        return $this->render('InfoMailBundle:infomail:index.html.twig', array(
            'infoMails' => $infoMails
        ));
    }

    /**
     * @param $id
     *
     * Send mail action
     */
    private function sendMail($id)
    {
        $mail = $this->get('doctrine')->getRepository('InfoMailBundle:InfoMail')->findOneById($id);

        $users = $this->get('doctrine')->getRepository('Application\Sonata\UserBundle\Entity\User')->findAll();

        $recipients = [];
        foreach($users as $user)
        {
            if ( $user->getEmail() != null )
            {
                $recipients[] = $user->getEmail();
            }
        }

        $sendMessage = \Swift_Message::newInstance()
            ->setSubject($mail->getSubject())
            ->setFrom('no-reply@gmail.com')
            ->setTo($recipients)
            ->setBody(
                $this->renderView(
                    'InfoMailBundle::index.html.twig',
                    array(
                        'mail' => $mail
                    )
                ),
                'text/html'
            );
        $this->get('mailer')->send($sendMessage);
    }

    public function sendAction(Request $request, $id) {
        $form = $this->createSendForm($id);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InfoMailBundle:InfoMail')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find InfoMail entity.');
            }

            $this->sendMail($entity->getId());

            return $this->redirect($this->generateUrl('infomail_show', array('id'=>$id)));
        }

        return $this->redirect($this->generateUrl('infomail_index'));
    }

    /**
     * Creates a form to send an InfoMail.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createSendForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('infomail_send', array('id' => $id)))
            ->setMethod('GET')
            ->add('submit', SubmitType::class, array(
                'label' => 'Send',
                'attr' => array('class' => 'btn btn-primary'),
            ))
            ->getForm()
            ;
    }

    /**
     * Creates a new InfoMail entity.
     *
     */
    public function newAction(Request $request)
    {
        $infoMail = new InfoMail();
        $form = $this->createForm('InfoMailBundle\Form\InfoMailType', $infoMail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($infoMail);
            $em->flush();

            return $this->redirectToRoute('infomail_show', array('id' => $infoMail->getId()));
        }

        return $this->render('InfoMailBundle:infomail:new.html.twig', array(
            'infoMail' => $infoMail,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a InfoMail entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $infoMail = $em->getRepository('InfoMailBundle:InfoMail')->findOneById($id);

        if (!$infoMail) {
            throw $this->createNotFoundException('Unable to find InfoMail entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $sendForm = $this->createSendForm($id);

        return $this->render('InfoMailBundle:infomail:show.html.twig', array(
            'infoMail' => $infoMail,
            'delete_form' => $deleteForm->createView(),
            'send_form' => $sendForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing InfoMail entity
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('InfoMailBundle:InfoMail')->findOneById($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InfoMail entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InfoMailBundle:infomail:edit.html.twig', array(
            'entity' => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Creates a form to edit a InfoMail entity.
     * @param InfoMail $entity
     * @return \Symfony\Component\Form\Form
     */
    private function createEditForm(InfoMail $entity)
    {
        $form = $this->createForm(InfoMailType::class, $entity, array(
            'action' => $this->generateUrl('infomail_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $form->add('submit', SubmitType::class, array('label' => 'Update'));
        return $form;
    }

    /**
     * Edits an existing InfoMail entity
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('InfoMailBundle:InfoMail')->findOneById($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InfoMail entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('infomail_edit', array('id' => $id)));
        }

        return $this->render('InfoMailBundle:infomail:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a InfoMail entity.
     *
     */
    public function deleteAction(Request $request, $id) {

        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid() || $request->isMethod('GET')) {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InfoMailBundle:InfoMail')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find InfoMail entity.');
            }

            $em->remove($entity);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('infomail_index'));
    }

    /**
     * Creates a form to delete a InfoMail entity.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('infomail_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, array(
                'label' => 'Delete',
                'attr' => array('class' => 'btn btn-danger'),
            ))
            ->getForm()
            ;
    }
}
