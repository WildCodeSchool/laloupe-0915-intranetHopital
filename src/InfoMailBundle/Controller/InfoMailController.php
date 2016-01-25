<?php

namespace InfoMailBundle\Controller;

use Sonata\AdminBundle\Exception\ModelManagerException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sonata\AdminBundle\Controller\CRUDController as Controller;

use InfoMailBundle\Entity\InfoMail;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * InfoMail controller.
 *
 */
class InfoMailController extends Controller
{
    public function sendAction($id)
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        $object->setDateLastSend(new \DateTime('now'));

        $this->admin->update($object);

        $this->sendMail($object->getId());

        $this->addFlash('sonata_flash_success', 'mail envoyé');

        return new RedirectResponse($this->admin->generateUrl('list'));
    }

    /**
     * @param $id
     * @return bool
     */
    private function sendMail($id)
    {
        $mail = $this->get('doctrine')->getRepository('InfoMailBundle:InfoMail')->findOneById($id);

        $users = $this->get('doctrine')->getRepository('Application\Sonata\UserBundle\Entity\User')->findAll();

            $recipients = [];
            foreach ($users as $user) {
                if ($user->getEmail() != null) {
                    $recipients[] = $user->getEmail();
                }
            }

            $sendMessage = \Swift_Message::newInstance()
                ->setSubject($mail->getSubject())
                ->setFrom('no-reply@ch-laloupe.fr')
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
            if ($mail->getFiles() != null) {
                foreach ($mail->getFiles() as $file) {
                    $sendMessage->attach(\Swift_Attachment::fromPath($file->getUploadRootDir() . '/' . $file->getPath())->setFilename($file->getName()));
                }
            }
            $this->get('mailer')->send($sendMessage);
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

                    if ($object instanceof InfoMail) {
                        $this->getDoctrine()->getEntityManager()->flush();
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
}