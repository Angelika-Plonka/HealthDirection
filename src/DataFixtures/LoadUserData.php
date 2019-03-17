<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class LoadUserData extends Fixture
{

    const REFERENCE_USER1 = 'user1';
    const REFERENCE_USER2 = 'user2';
    const REFERENCE_USER3 = 'user3';
    const USER1_PASSWORD = 'fhs834dd';
    const USER2_PASSWORD = 'ben7e4ecb';
    const USER3_PASSWORD = 'scn48bnc';

    public function load(ObjectManager $manager)
    {
        $user1 = (new User())
            ->setFirstName('Adam')
            ->setLastName('Kowalski')
            ->setUsername('adam')
            ->setEmail('adam@test.pl')
            ->setPlainPassword(self::USER1_PASSWORD)
            ->setEnabled(true)
        ;
        $manager->persist($user1);

        $user2 = (new User())
            ->setFirstName('Anna')
            ->setLastName('Nowak')
            ->setUsername('anka')
            ->setEmail('anna88@test.pl')
            ->setPlainPassword(self::USER2_PASSWORD)
            ->setEnabled(true)
        ;
        $manager->persist($user2);

        $user3 = (new User())
            ->setFirstName('Kasia')
            ->setLastName('Pospolita')
            ->setUsername('kasia')
            ->setEmail('kasia@test.pl')
            ->setPlainPassword(self::USER3_PASSWORD)
            ->setEnabled(true)
        ;
        $manager->persist($user3);

        $manager->flush();

        $this->addReference(self::REFERENCE_USER1, $user1);
        $this->addReference(self::REFERENCE_USER2, $user2);
        $this->addReference(self::REFERENCE_USER3, $user3);
    }

}
