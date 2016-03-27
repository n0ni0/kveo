<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CollectionController extends Controller
{
    /**
     * @Route("/{slug}/collection/", name="collection_show")
     */
    public function showCollectionAction()
    {
        $user = $this->getUser()->getId();
        $collection = $this->getDoctrine()->getRepository('AppBundle:State')->findCollection($user);
        
        return $this->render('collection/collectionShow.html.twig', array(
            'collection' => $collection
        ));
    }
}