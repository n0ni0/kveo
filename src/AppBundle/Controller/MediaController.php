<?php
/**
 * Created by PhpStorm.
 * User: Antonio
 * Date: 29/02/16
 * Time: 18:16
 */

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

        $person   = $this->getDoctrine()->getRepository('AppBundle:Person')->findById($id);

        return $this->render('media/media.html.twig', array(
            'selected' => $selected,
            'person'   => $person,
        ));
    }
}