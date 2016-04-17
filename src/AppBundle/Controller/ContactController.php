<?php

namespace AppBundle\Controller;


use AppBundle\Form\ContactFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/contact/", name="contact_form")
     */
    public function showContactAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted()){
            $data = $form->getData();
            $this->get('kveo_mailer')->sendMail($data, $user);

            $request->getSession()->getFlashBag()->add(
                'notice',
                $this->get('translator')->trans('flash.contact', array(), 'messages'
                ));

            return $this->redirectToRoute('home');
        }

        return $this->render('contact/contactForm.html.twig', array(
            'form' => $form->createView()
        ));
    }
}