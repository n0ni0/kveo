<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\CommentType;

/**
 * @Route("/comment")
 */
class CommentController extends Controller
{
    /**
     * @Route("/{media}/", name="comment_create", options={"expose"=true})
     * @Method("POST")
     * @ParamConverter("media", class="AppBundle:Media")
     */
    public function newCommentAction(Request $request, $media)
    {

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $data->setUser($this->getUser());
            $data->setMedia($media);

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return new JsonResponse('Success!');

        }

        return $this->render('comment/newComment.html.twig', array(
            'media' => $media,
            'form'  => $form->createView()
        ));

    }

}