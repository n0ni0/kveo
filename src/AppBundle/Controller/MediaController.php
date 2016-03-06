<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MediaController extends Controller
{
    /**
     * @Route("/media/{slug}/", name="media")
     */
    public function showMediaAction($slug)
    {
        $selected = $this->getDoctrine()->getRepository('AppBundle:Media')->findOneBySlug($slug);
        $id = $selected->getId();

        $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')->findByMedia($id);

        return $this->render('media/media.html.twig', array(
            'selected' => $selected,
            'comment'  => $comments,
        ));
    }
}