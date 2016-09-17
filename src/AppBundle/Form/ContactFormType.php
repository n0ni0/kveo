<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('message', TextareaType::class, array(
                'label'       => 'message',
                'attr' => array(
                    'placeholder' => 'contact.message',
                )));
    }

    public function getBlockPrefix()
    {
        return 'app_contact';
    }
}