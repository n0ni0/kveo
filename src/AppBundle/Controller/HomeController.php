<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $media = $this->getDoctrine()->getRepository('AppBundle:Media')->findAll();
        return $this->render('home/index.html.twig', array(
            'media' => $media
        ));
    }

    /**
     * @Route("/catalog/{mediaType}/", name="catalog")
     */
    public function catalogAction($mediaType)
    {
        $media      = $this->getDoctrine()->getRepository('AppBundle:Media')->findByMediaType($mediaType);
        $mediaTypes = $this->getDoctrine()->getRepository('AppBundle:MediaType')->findOneById($mediaType);

        if(!$media){
            $this->addFlash(
                'notice',
                'No existe nada aún, vuelve pasados unos días'
            );
        }

        return $this->render('home/catalog.html.twig', array(
            'media'      => $media,
            'mediaTypes' => $mediaTypes
        ));
    }
}
