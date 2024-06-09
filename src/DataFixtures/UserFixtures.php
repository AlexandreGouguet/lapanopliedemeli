<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const USER_1 = 'user_1';
    public const USER_2 = 'user_2';
    public const USER_3 = 'user_3';

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setIsVerified(false);
        $user1->setEmail('notverified@panopli.fr');
        $user1->setRoles(['ROLE_USER']);
        $hashedPassword = $this->passwordHasher->hashPassword($user1, 'P@ssw0rd');
        $user1->setPassword($hashedPassword);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setIsVerified(true);
        $user2->setEmail('verified@panopli.fr');
        $user2->setRoles(['ROLE_USER']);
        $hashedPassword = $this->passwordHasher->hashPassword($user2, 'P@ssw0rd');
        $user2->setPassword($hashedPassword);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setIsVerified(true);
        $user3->setEmail('admin@panopli.fr');
        $user3->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $hashedPassword = $this->passwordHasher->hashPassword($user3, 'P@ssw0rd');
        $user3->setPassword($hashedPassword);
        $manager->persist($user3);

        $this->addReference(self::USER_1, $user1);
        $this->addReference(self::USER_2, $user2);
        $this->addReference(self::USER_3, $user3);

        $manager->flush();
    }
}
