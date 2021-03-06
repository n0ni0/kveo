<?php

namespace AppBundle\Utils;



use Symfony\Component\Templating\EngineInterface;

class Mailer
{
    protected $mailer;
    protected $templating;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating )
    {
        $this->mailer     = $mailer;
        $this->templating = $templating;
    }

    public function sendMail($data, $user)
    {
        $message = \Swift_Message::newInstance()
            ->setContentType('text/html')
            ->setSubject('Formulario de contacto')
            ->setFrom(array('example.email@kveo.local' => 'noreply@kveo.local'))
            ->setTo($user->getEmail())
            ->setBcc('example.email@kveo.local')
            ->setBody($this->templating->render('contact/mailTemplate.html.twig',
                array('name'    => $user->getUsername(),
                      'email'   => $user->getEmail(),
                      'message' => $data['message']
                )));

        $this->mailer->send($message);
    }
}