<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {

        $admin_user = new User();
        $admin_user->setEmail('admin@admin.com')
            ->setPassword($this->passwordHasher->hashPassword($admin_user, 'password123'))
            ->setRoles(['ROLE_SUPER_ADMIN'])
        ;
        $manager->persist($admin_user);
        $manager->flush();
    }
}
