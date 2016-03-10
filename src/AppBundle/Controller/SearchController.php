<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Media;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="media_search")
     * @Method("GET")
     *
     * @return JsonResponse
     */
    public function searchAction(Request $request)
    {
        $medias = array();

        $query = $request->query->get('q', '');

        $terms = $this->get('term_splitter')->splitIntoTerms($query, 2);

        if (!empty($terms)) {
            $medias = $this
                ->getDoctrine()
                ->getRepository('AppBundle:Media')
                ->createQueryBuilderForTerms($terms, 'm')
                ->orderBy('m.title', 'DESC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
        }

        $results = array();

        foreach ($medias as $media) {
            array_push($results, array(
                'result' => htmlspecialchars($media->getTitle()),
                'url'    => $this->generateUrl('media', array('slug' => $media->getSlug())),
            ));
        }

        return new JsonResponse($results);
    }
}