<?php

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\AdminBundle\Controller;

use Application\Sonata\UserBundle\Entity\User;
use IuchBundle\Entity\Charte;
use IuchBundle\Entity\Materiel;
use IuchBundle\Entity\Photo;
use IuchBundle\Entity\Service;
use IuchBundle\Entity\Tenue;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Exception\ModelManagerException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CRUDController extends \Sonata\AdminBundle\Controller\CRUDController
{

    private function logModelManagerException($e)
    {
        $context = array('exception' => $e);
        if ($e->getPrevious()) {
            $context['previous_exception_message'] = $e->getPrevious()->getMessage();
        }
        $this->getLogger()->error($e->getMessage(), $context);
    }
    /**
     * Edit action.
     *
     * @param int|string|null $id
     *
     * @return Response|RedirectResponse
     *
     * @throws NotFoundHttpException If the object does not exist
     * @throws AccessDeniedException If access is not granted
     */
    public function editAction($id = null)
    {
        // the key used to lookup the template
        $templateKey = 'edit';

        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('EDIT', $object)) {
            throw new AccessDeniedException();
        }

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);

        if ($this->getRestMethod() == 'POST') {
            $form->submit($this->get('request'));

            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {
                try {

                    // IUCH add preUpload manually to fix file edit
                    if ($object instanceof Charte || $object instanceof Photo) {
                        $object->removeUpload();
                    }

                    /**
                     * IUCH
                     * Supp photo dans user pour pouvoir supprimer photo (car user est le owner de la relation)
                     */
                    if ($object instanceof Photo)
                    {
                        $user = $object->getUser();
                        $object->setUser($user);
                        $object->setNom($user->getUsername());
                    }

                    // IUCH add preUpload manually to fix file edit
                    if ($object instanceof Charte || $object instanceof Photo) {
                        $object->preUpload();
                    }

                    /**
                     * IUCH
                     * Editer l'intervenant
                     */
                    if ($object instanceof Materiel || $object instanceof Tenue)
                    {
                        $user = $this->getUser();
                        $object->setIntervenant($user);
                    }

                    $object = $this->admin->update($object);

                    if ($this->isXmlHttpRequest()) {
                        return $this->renderJson(array(
                            'result'    => 'ok',
                            'objectId'  => $this->admin->getNormalizedIdentifier($object),
                        ));
                    }

                    $this->addFlash(
                        'sonata_flash_success',
                        $this->admin->trans(
                            'flash_edit_success',
                            array('%name%' => $this->escapeHtml($this->admin->toString($object))),
                            'SonataAdminBundle'
                        )
                    );

                    // redirect to edit mode
                    return $this->redirectTo($object);
                } catch (ModelManagerException $e) {
                    $this->logModelManagerException($e);

                    $isFormValid = false;
                }
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest()) {
                    $this->addFlash(
                        'sonata_flash_error',
                        $this->admin->trans(
                            'flash_edit_error',
                            array('%name%' => $this->escapeHtml($this->admin->toString($object))),
                            'SonataAdminBundle'
                        )
                    );
                }
            } elseif ($this->isPreviewRequested()) {
                // enable the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
                $this->admin->getShow();
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'edit',
            'form'   => $view,
            'object' => $object,
        ));

    }

    /**
     * Create action.
     *
     * @return Response
     *
     * @throws AccessDeniedException If access is not granted
     */
    public function createAction()
    {
        // the key used to lookup the template
        $templateKey = 'edit';

        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $object = $this->admin->getNewInstance();

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);

        if ($this->getRestMethod() == 'POST') {
            $form->submit($this->get('request'));

            $isFormValid = $form->isValid();

            if ($object instanceof User) {

                // IUCH Send a welcome mail
                $this->sendWelcomeMail($object);

                // IUCH Update the password with the dateOfBirth
                $birthDate = $object->getDateOfBirth();
                $datePassword = $birthDate->format('dmy');
                $object->setPlainPassword($datePassword);

            }
            /**
             * IUCH
             * Enregistrer photo dans user car user est le owner de la relation
             */
            if ($object instanceof Photo)
            {
                $user = $object->getUser();
                $user->setPhoto($object);
            }

            /**
             * IUCH
             * Enregistrer l'intervenant
             */
            if ($object instanceof Materiel || $object instanceof Tenue)
            {
                $user = $this->getUser();
                $object->setIntervenant($user);
            }
            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {
                if (false === $this->admin->isGranted('CREATE', $object)) {
                    throw new AccessDeniedException();
                }

                try {
                    $object = $this->admin->create($object);
                    if ($this->isXmlHttpRequest()) {
                        return $this->renderJson(array(
                            'result'   => 'ok',
                            'objectId' => $this->admin->getNormalizedIdentifier($object),
                        ));
                    }

                    $this->addFlash(
                        'sonata_flash_success',
                        $this->admin->trans(
                            'flash_create_success',
                            array('%name%' => $this->escapeHtml($this->admin->toString($object))),
                            'SonataAdminBundle'
                        )
                    );

                    // redirect to edit mode
                    return $this->redirectTo($object);
                } catch (ModelManagerException $e) {
                    $this->logModelManagerException($e);

                    $isFormValid = false;
                }
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest()) {
                    $this->addFlash(
                        'sonata_flash_error',
                        $this->admin->trans(
                            'flash_create_error',
                            array('%name%' => $this->escapeHtml($this->admin->toString($object))),
                            'SonataAdminBundle'
                        )
                    );
                }
            } elseif ($this->isPreviewRequested()) {
                // pick the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
                $this->admin->getShow();
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'create',
            'form'   => $view,
            'object' => $object,
        ));
    }

    // IUCH welcomeMail send function - $object represent the created user
    private function sendWelcomeMail($object){
        $mails = $this->get('doctrine')->getRepository('InfoMailBundle:InfoMail')->findByType('mail de bienvenue');
        //on récupère le dernier mail de bienvenue créé
        $mail = end($mails);

        if($object->getEmail() != NULL && $mails != false) {

            $destinataire = $object->getEmail();
            $sendMessage = \Swift_Message::newInstance()
                ->setSubject($mail->getSubject())
                ->setFrom('sacha@ch-laloupe.fr')
                ->setTo($destinataire)
                ->setBody(
                    $this->renderView(
                        'InfoMailBundle::welcome_mail.html.twig',
                        array(
                            'user' => $object,
                            'mail' => $mail
                        )
                    ),
                    'text/html'
                );
            if ($this->container->hasParameter('mail.copy_chef_service.enabled') && $this->container->getParameter('mail.copy_chef_service.enabled') == true) {
                if ($object->getService()->getChefService()->getEmail())
                    $mail_chef_service = $object->getService()->getChefService()->getEmail();
                $sendMessage->setCc($mail_chef_service);
            }
            if ($mail->getFiles() != null) {
                foreach ($mail->getFiles() as $file) {
                    $sendMessage->attach(\Swift_Attachment::fromPath($file->getUploadRootDir() . '/' . $file->getPath())->setFilename($file->getName()));
                }
            }
            $this->get('mailer')->send($sendMessage);

            $mail->setDateLastSend(new \DateTime('now'));
        }
    }

    /**
     * Delete action.
     *
     * @param int|string|null $id
     *
     * @return Response|RedirectResponse
     *
     * @throws NotFoundHttpException If the object does not exist
     * @throws AccessDeniedException If access is not granted
     */
    public function deleteAction($id)
    {
        $id     = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('DELETE', $object)) {
            throw new AccessDeniedException();
        }

        if ($this->getRestMethod() == 'DELETE') {
            // check the csrf token
            $this->validateCsrfToken('sonata.delete');

            /**
             * IUCH
             * Supp photo dans user pour pouvoir supprimer photo (car user est le owner de la relation)
             */
            if ($object instanceof Photo)
            {
                $user = $object->getUser();

                $user->setPhoto(null);
            }

            try {
                $this->admin->delete($object);

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array('result' => 'ok'));
                }

                $this->addFlash(
                    'sonata_flash_success',
                    $this->admin->trans(
                        'flash_delete_success',
                        array('%name%' => $this->escapeHtml($this->admin->toString($object))),
                        'SonataAdminBundle'
                    )
                );
            } catch (ModelManagerException $e) {
                $this->logModelManagerException($e);

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array('result' => 'error'));
                }

                $this->addFlash(
                    'sonata_flash_error',
                    $this->admin->trans(
                        'flash_delete_error',
                        array('%name%' => $this->escapeHtml($this->admin->toString($object))),
                        'SonataAdminBundle'
                    )
                );
            }

            return $this->redirectTo($object);
        }

        return $this->render($this->admin->getTemplate('delete'), array(
            'object'     => $object,
            'action'     => 'delete',
            'csrf_token' => $this->getCsrfToken('sonata.delete'),
        ));
    }

    /**
     *
     * Custom action to reset the password at the date of birth
     * Set the last login to null to simulate first connexion (change password at connexion though)
     *
     * @return RedirectResponse
     */
    public function resetAction()
    {
        $id     = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('DELETE', $object)) {
            throw new AccessDeniedException();
        }

        if ($this->getRestMethod() == 'DELETE') {
            // check the csrf token
            $this->validateCsrfToken('sonata.reset');

        if ($this->admin->isGranted('DELETE') === false)
        {
            throw new AccessDeniedException();
        }

        try {
            $birthDate = $object->getDateOfBirth();
            $datePassword = $birthDate->format('dmy');

            $object->setLastLoginNull();

            $object->setPlainPassword($datePassword);

            $this->admin->update($object);

            $this->addFlash('sonata_flash_success', 'mot de passe réinitialisé');

        } catch (ModelManagerException $e) {
            $this->logModelManagerException($e);

            if ($this->isXmlHttpRequest()) {
                return $this->renderJson(array('result' => 'error'));
            }

            $this->addFlash(
                'sonata_flash_error',
                $this->admin->trans(
                    'Erreur : le mot de passe n\'a pas été réinitialisé',
                    array('%name%' => $this->escapeHtml($this->admin->toString($object))),
                    'SonataAdminBundle'
                )
            );
        }

            return $this->redirectTo($object);
        }

        return $this->render('@ApplicationSonataUser/reset.html.twig', array(
            'object'     => $object,
            'action'     => 'reset',
            'csrf_token' => $this->getCsrfToken('sonata.reset'),
        ));

    }
}
