<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Media;
use AppBundle\Entity\State;
use AppBundle\Form\StateFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StateController extends  Controller
{
    /**
     * @Route("/media/{media}/state/new/", name="new_state")
     */
    public function NewStateAction(Request $request, Media $media)
    {
        $state = new State();
        $form = $this->createForm(StateFormType::class, $state);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $data->setUser($this->getUser());
            $data->setMedia($media);

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirectToRoute('media', array(
                'slug' => $media->getSlug()
            ));
        }

        return $this->render('state/newState.html.twig', array(
            'media' => $media,
            'form'  => $form->createView()
        ));
    }

    /**
     * @Route("/media/{media}/state/{state}/edit", name="edit_state")
     */
    public function EditStateAction(Request $request, Media $media, State $state)
    {
        $form = $this->createForm(StateFormType::class, $state);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($state);
            $em->flush();

            return $this->redirectToRoute('media', array(
                'slug' => $media->getSlug()
            ));
        }

        return $this->render('state/newState.html.twig', array(
            'media' => $media,
            'state' => $state,
            'form'  => $form->createView()
        ));
    }
}