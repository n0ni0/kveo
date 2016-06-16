<?php

namespace tests\AppBundle\Form;


use AppBundle\Form\CommentType;
use Symfony\Component\Form\Test\TypeTestCase;

class CommentTypeTest extends TypeTestCase
{
    public function testSubmitCommentTypeForm()
    {
        $formData = array(
            'comment' => 'CommentTypeForm test'
        );

        $form = $this->factory->create(CommentType::class);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}