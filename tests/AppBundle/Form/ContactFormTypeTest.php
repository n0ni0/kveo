<?php

namespace tests\AppBundle\Form;


use AppBundle\Form\ContactFormType;
use Symfony\Component\Form\Test\TypeTestCase;

class ContactFormTypeTest extends TypeTestCase
{
    public function testSubmitContactTypeForm()
    {
        $formData = array(
            'message' => 'Hello world'
        );

        $form = $this->factory->create(ContactFormType::class);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}