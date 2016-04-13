<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label'       => 'easy.name',
                'attr' => array(
                    'placeholder' => 'Nombre:',
                )))
            ->add('email', EmailType::class, array(
                'label'       => 'easy.email',
                'attr' => array(
                    'placeholder' => 'Email:',
                )))
            ->add('message', TextareaType::class, array(
                'label'       => 'message',
                'attr' => array(
                    'placeholder' => 'Introduzca su mensaje',
                )));
    }
}