<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }


    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setVerified(false);
        $user->setEmail('notverified@panopli.fr');
        $user->setRoles(['ROLE_USER']);
        $hashedPassword = $this->passwordHasher->hashPassword($user, 'P@ssw0rd');
        $user->setPassword($hashedPassword);
        $manager->persist($user);

        $user = new User();
        $user->setVerified(true);
        $user->setEmail('verified@panopli.fr');
        $user->setRoles(['ROLE_USER']);
        $hashedPassword = $this->passwordHasher->hashPassword($user, 'P@ssw0rd');
        $user->setPassword($hashedPassword);
        $manager->persist($user);

        $user = new User();
        $user->setVerified(true);
        $user->setEmail('admin@panopli.fr');
        $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $hashedPassword = $this->passwordHasher->hashPassword($user, 'P@ssw0rd');
        $user->setPassword($hashedPassword);
        $manager->persist($user);

        $manager->flush();
    }
}
