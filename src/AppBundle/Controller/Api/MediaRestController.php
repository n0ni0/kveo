<?php

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Media;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * @RouteResource("/media")
 */
class MediaRestController extends FOSRestController
{
    /**
     * @return array
     * @View(serializerGroups={"list"})
     * @ApiDoc(
     *     description="Return media info by id with most important fields",
     *     requirements={
     *      {"name"="id", "dataType"="integer", "description"="media id"}
     *     },
     *     output={
     *      "class"  = "AppBundle\Entity\Media",
     *      "groups" = "list"
     *     },
     *     statusCodes={
     *      200 = "Returned when successful",
     *      404 = "Returned when not found"
     *     }
     * )
     */
    public function basicInfoAction(Media $id){
        return $this->getDoctrine()->getRepository('AppBundle:Media')->find($id);
    }

    /**
     * @param Media $id
     * @return object
     * @ApiDoc(
     *     description="Return media info by id with all fields",
     *     requirements={
     *      {"name"="id", "dataType"="integer", "description"="media id"}
     *     },
     *     output={
     *      "class"  = "AppBundle\Entity\Media",
     *      "groups" = "details"
     *     },
     *     statusCodes={
     *      200 = "Returned when successful",
     *      404 = "Returned when not found"
     *     }
     * )
     */
    public function fullInfoAction(Media $id)
    {
        return $this->getDoctrine()->getRepository('AppBundle:Media')->find($id);
    }
}