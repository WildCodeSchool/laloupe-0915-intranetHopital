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
    public function sendAction()
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
}
