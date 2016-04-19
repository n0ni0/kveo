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
        $id       = $selected->getId();
        $user     = $this->getUser()->getId();
        $vote     = $this->getDoctrine()->getRepository('AppBundle:Vote')->findVoteIfExist($id, $user);
        $state    = $this->getDoctrine()->getRepository('AppBundle:State')->findStateByMedia($id, $user);

        $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')->findByMedia(
            array('id'          => $id),
            array('publishedAt' => 'DESC'
            ));

        return $this->render('media/media.html.twig', array(
            'selected' => $selected,
            'comment'  => $comments,
            'vote'     => $vote,
            'state'    => $state
        ));
    }
}