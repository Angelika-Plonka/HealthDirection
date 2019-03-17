<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\BasicInformation;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\LoadUserData;

class LoadBasicInformationData extends Fixture implements DependentFixtureInterface
{

    const REFERENCE_BASIC_INFORMATION1 = 'basic_information1';
    const REFERENCE_BASIC_INFORMATION2 = 'basic_information2';
    const REFERENCE_BASIC_INFORMATION3 = 'basic_information3';

    public function load(ObjectManager $manager)
    {
        /* @var $user1 \App\Entity\User */
        $user1 = $this->getReference(LoadUserData::REFERENCE_USER1);
        /* @var $user1 \App\Entity\User */
        $user2 = $this->getReference(LoadUserData::REFERENCE_USER2);
        /* @var $user1 \App\Entity\User */
        $user3 = $this->getReference(LoadUserData::REFERENCE_USER3);

        $basicInformation1 = (new BasicInformation())
            ->setHeight(180)
            ->setSex(BasicInformation::SEX_M)
            ->setBirthday(new \DateTime('1982-12-12'))
            ->setActivity(BasicInformation::ACTIVITY_SCALE_4)
            ->setDiet(BasicInformation::DIET_BALANCED)
            ->setUser($user1)
        ;
        $manager->persist($basicInformation1);

        $basicInformation2 = (new BasicInformation())
            ->setHeight(160)
            ->setSex(BasicInformation::SEX_F)
            ->setBirthday(new \DateTime('1989-02-12'))
            ->setActivity(BasicInformation::ACTIVITY_SCALE_2)
            ->setDiet(BasicInformation::DIET_VEGANISM)
            ->setUser($user2)
        ;
        $manager->persist($basicInformation2);

        $basicInformation3 = (new BasicInformation())
            ->setHeight(172)
            ->setSex(BasicInformation::SEX_F)
            ->setBirthday(new \DateTime('1990-03-12'))
            ->setActivity(BasicInformation::ACTIVITY_SCALE_3)
            ->setDiet(BasicInformation::DIET_GLUTEN_FREE)
            ->setUser($user3)
        ;
        $manager->persist($basicInformation3);

        $manager->flush();

        $this->addReference(self::REFERENCE_BASIC_INFORMATION1, $basicInformation1);
        $this->addReference(self::REFERENCE_BASIC_INFORMATION2, $basicInformation2);
        $this->addReference(self::REFERENCE_BASIC_INFORMATION3, $basicInformation3);
    }

    public function getDependencies(): array
    {
        return [
            LoadUserData::class
        ];
    }

}
