<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Users extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function getOrder()
    {
        return 50;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $admin = $userManager->createUser();
        $admin->setUsername('admin');
        $admin->setEmail('admin@kveo.local');
        $admin->setPlainPassword('admin');
        $admin->setEnabled('true');
        $admin->setRoles(array('ROLE_ADMIN'));

        $userManager->updateUser($admin, true);

        $user = $userManager->createUser();
        $user->setUsername('username');
        $user->setEmail('username@kveo.local');
        $user->setPlainPassword('username');
        $user->setEnabled('true');
        $user->setRoles(array('ROLE_ADMIN'));

        $userManager->updateUser($user, true);

        $user = $userManager->createUser();
        $user->setUsername('admin');
        $user->setEmail('admin@kveo.local');
        $user->setPlainPassword('admin');
        $user->setEnabled('true');
        $user->setRoles(array('ROLE_SUPER_ADMIN'));

        $userManager->updateUser($user, true);
    }
}