<?php

namespace IuchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;

class PhotoController extends Controller
{
    /**
     *
     * @param $photo_file
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function trombinoscopeAction()
    {
        $services = $this->get('doctrine')
            ->getRepository('IuchBundle:Service')
            ->findAll();

        return $this->render('IuchBundle:Photo:trombinoscope.html.twig', array(
            'services' => $services,
        ));
    }

    /**
     *
     * @param $photo_file
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function getPhotoAction($photo_id)
    {
        if (!$this->getUser())
        {
            return $this->redirectToRoute('fos_user_security_login');
        }

        $photo_file = $this->get('doctrine')
            ->getRepository('IuchBundle:Photo')
            ->findOneById($photo_id)->getNom();
        // Generate response
        $response = new Response();

        $filepath = $this->get('kernel')->getRootDir()."/uploads/photos/".$photo_file;
        $photoFile = new File($filepath);
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', $photoFile->getMimeType());
        $response->headers->set('Content-Disposition', 'inline; filepath="' . $photoFile->getBasename() . '";');
        $response->headers->set('Content-length', $photoFile->getSize());

        // Send headers before outputting anything
        $response->sendHeaders();

        $response->setContent(file_get_contents($filepath));

        return $response;
    }
}
