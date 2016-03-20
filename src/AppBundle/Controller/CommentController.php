<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Media;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\CommentType;

/**
 * @Route("/media")
 */
class CommentController extends Controller
{
    /**
     * @Route("/{media}/comment/new/", name="comment_create", options={"expose"=true})
     * @Method("POST")
     * @ParamConverter("media", class="AppBundle:Media")
     */
    public function newCommentAction(Request $request, Media $media)
    {
        //if (!$request->isXmlHttpRequest()) {
        //    return new JsonResponse(array('message' => 'You can access this only using Ajax!'));
        //}

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

    /**
     * @Route("/{media}/comment/{id}/edit", name="comment_edit")
     * @ParamConverter("media", class="AppBundle:Media")
     * @Method({"GET", "POST"})
     */
    public function editCommentAction(Request $request, Comment $comment, Media $media){
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $now  = new \DateTime();
            $data = $form->getData();
            $data->setEditedAt($now);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('media', array(
                'slug' => $media->getSlug()
            ));
        }

        return $this->render('comment/editComment.html.twig', array(
            'comment'     => $comment,
            'form'        => $form->createView(),
        ));
    }

    /**
     * @Route("/{media}/comment/{id}/delete", name="comment_delete")
     * @ParamConverter("media", class="AppBundle:Media")
     */
    public function deleteCommentAction(Comment $comment, Media $media)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();

        return $this->redirectToRoute('media', array(
            'slug' => $media->getSlug(),
        ));
    }

}