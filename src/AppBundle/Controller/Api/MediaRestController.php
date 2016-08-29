<?php

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Media;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * @RouteResource("/media")
 */
class MediaRestController extends FOSRestController
{
    /**
     * @return array
     * @View(serializerGroups={"list"})
     */
    public function basicInfoAction(Media $id){
        return $this->getDoctrine()->getRepository('AppBundle:Media')->find($id);
    }

    /**
     * @param Media $id
     * @return object
     */
    public function fullInfoAction(Media $id)
    {
        return $this->getDoctrine()->getRepository('AppBundle:Media')->find($id);
    }
}