<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Person;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/person")
 */
class PersonController extends Controller
{
    /**
     * @Route("/{slug}", name="person_show")
     * @Method("GET")
     */
    public function showPersonAction(Person $person)
    {
        return $this->render('person/personShow.html.twig', array(
            'person' => $person
        ));
    }
}