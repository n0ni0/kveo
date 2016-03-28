<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Media;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        $media = $this->getDoctrine()->getRepository('AppBundle:Vote')->findMediaTrends();

        $paginator = $this->get('knp_paginator');
        $medias    = $paginator->paginate(
            $media,
            $request->query->getInt('page', 1), $pages = Media::NUM_ITEMS);

        return $this->render('home/index.html.twig', array(
            'medias'      => $medias,
        ));
    }

    /**
     * @Route("/catalog/{mediaType}/", name="catalog")
     */
    public function catalogAction(Request $request, $mediaType)
    {
        $media      = $this->getDoctrine()->getRepository('AppBundle:Media')->findByMediaType($mediaType);
        $mediaTypes = $this->getDoctrine()->getRepository('AppBundle:MediaType')->findOneById($mediaType);

        if(!$media){
            $this->addFlash(
                'notice',
                'No existe nada aún, vuelve pasados unos días'
            );
        }

        $paginator = $this->get('knp_paginator');
        $medias    = $paginator->paginate(
            $media,
            $request->query->getInt('page', 1), $pages = Media::NUM_ITEMS);

        return $this->render('home/catalog.html.twig', array(
            'medias'      => $medias,
            'mediaTypes'  => $mediaTypes
        ));
    }
}
