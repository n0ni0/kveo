<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Media;
use AppBundle\Entity\Vote;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\VoteType;

class VoteController extends Controller
{
    /**
     * @Route("/media/{media}/vote/new/", name="new_vote")
     * @ParamConverter("media", class="AppBundle:Media")
     * @Method("POST")
     */
    public function newVoteAction(Request $request, Media $media)
    {
        $vote = new Vote();
        $form = $this->createForm(VoteType::class, $vote);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $data->setUser($this->getUser());
            $data->setMedia($media);

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirectToRoute('media',array(
                'slug' => $media->getSlug()
            ));
        }

        return $this->render('vote/newVote.html.twig', array(
            'media' => $media,
            'form'  => $form->createView()
        ));
    }

    /**
     * @Route("/media/{media}/vote/{vote}/edit/", name="edit_vote")
     */
    public function editVoteAction(Request $request, Media $media, Vote $vote)
    {
        $form = $this->createForm(VoteType::class, $vote);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($vote);
            $em->flush();

            return $this->redirectToRoute('media', array(
                'slug' => $media->getSlug()
            ));
        }

        return $this->render('vote/editVote.html.twig', array(
            'media'     => $media,
            'vote'      => $vote,
            'form'      => $form->createView(),
        ));
    }
}