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

    public function sendMail($data)
    {
        $message = \Swift_Message::newInstance()
            ->setContentType('text/html')
            ->setSubject('Formulario de contacto')
            ->setFrom(array('mecaigotolosdias@gmail.com' => 'noreply@kveo.local'))
            ->setTo($data['email'])
            ->setBcc('ajimenez.bf@gmail.com')
            ->setBody($this->templating->render('contact/mailTemplate.html.twig',
                array('name'    => $data['name'],
                      'email'   => $data['email'],
                      'message' => $data['message']
                )));

        $this->mailer->send($message);
    }
}