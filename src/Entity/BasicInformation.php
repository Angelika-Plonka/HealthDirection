<?php

namespace App\Entity;

use App\Entity\User;
use App\Service\ToolsProvider;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BasicInformationRepository")
 */
class BasicInformation
{

    use ORMBehaviors\Timestampable\Timestampable;

    /**
     * TYPE OF SEX
     */
    const SEX_M = 'M';
    const SEX_F = 'F';

    /**
     * ACTIVITY SCALE
     */
    const ACTIVITY_SCALE_1 = '1.4';
    const ACTIVITY_SCALE_2 = '1.75';
    const ACTIVITY_SCALE_3 = '2';
    const ACTIVITY_SCALE_4 = '2.2';
    const ACTIVITY_SCALE_5 = '2.4';

    /**
     * TYPE OF DIETS
     */
    const DIET_BALANCED = 'balanced';
    const DIET_VEGETARIANISM = 'vegetarianism';
    const DIET_VEGANISM = 'veganism';
    const DIET_ROW_FOODISM = 'raw_foodism';
    const DIET_FRUITARIANISM = 'fruitarianism';
    const DIET_GLUTEN_FREE = 'gluten_free';
    const DIET_PALEO = 'paleo';
    const DIET_CUSTOMIZED = 'customized';

    public static function getTypeSex(): array
    {
        return [
            'basic_information.sex.m' => self::SEX_M,
            'basic_information.sex.f' => self::SEX_F
        ];
    }

    public static function getTypeActivity(): array
    {
        return [
            'basic_information.activity.scale_1' => self::ACTIVITY_SCALE_1,
            'basic_information.activity.scale_2' => self::ACTIVITY_SCALE_2,
            'basic_information.activity.scale_3' => self::ACTIVITY_SCALE_3,
            'basic_information.activity.scale_4' => self::ACTIVITY_SCALE_4,
            'basic_information.activity.scale_5' => self::ACTIVITY_SCALE_5
        ];
    }

    public static function getTypeDiet(): array
    {
        return [
            'basic_information.diet.balanced' => self::DIET_BALANCED,
            'basic_information.diet.vegetarianism' => self::DIET_VEGETARIANISM,
            'basic_information.diet.veganism' => self::DIET_VEGANISM,
            'basic_information.diet.raw_foodism' => self::DIET_ROW_FOODISM,
            'basic_information.diet.fruitarianism' => self::DIET_FRUITARIANISM,
            'basic_information.diet.gluten_free' => self::DIET_GLUTEN_FREE,
            'basic_information.diet.paleo' => self::DIET_PALEO,
            'basic_information.diet.customized' => self::DIET_CUSTOMIZED,
        ];
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="string", length=1)
     * @Assert\Choice(callback="getTypeOfSex", message="message.wrong_choice")
     * @Assert\NotBlank()
     */
    private $sex;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     * @Assert\Choice(callback="getTypeActivity", message="message.wrong_choice")
     */
    private $activity;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     * @Assert\Choice(callback="getTypeDiet", message="message.wrong_choice")
     */
    private $diet;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="basicInformation")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     * @Assert\NotBlank()
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     *
     * @param string $sex
     * @return \self
     * @throws \Exception
     */
    public function setSex(?string $sex): self
    {
        if (!in_array($sex, self::getTypeSex())) {
            throw new \Exception('Nieprawidłowa wartość dla pola płeć: ' . $sex);
        }

        $this->sex = $sex;

        return $this;
    }

    public function getSexTranslate(): ?string
    {
        return ToolsProvider::getKeyFromFlippedArray($this->sex, self::getTypeSex());
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Calculate age on the basis of date of birth
     *
     * @return integer
     */
    public function getAge(): ?int
    {
        if (null === $this->getBirthday()) {
            return null;
        }

        return $this->getBirthday()->diff(new \DateTime('today'))->y;
    }

    public function getActivity(): ?string
    {
        return $this->activity;
    }

    public function getActivityTranslate(): ?string
    {
        return ToolsProvider::getKeyFromFlippedArray($this->activity, self::getTypeActivity());
    }

    /**
     * @param string $activity
     * @return \self
     * @throws \Exception
     */
    public function setActivity(?string $activity): self
    {
        if (!in_array($activity, self::getTypeActivity())) {
            throw new \Exception('Błędny typ aktywności: ' . $activity);
        }
        $this->activity = $activity;

        return $this;
    }

    public function getDiet(): ?string
    {
        return $this->diet;
    }

    public function getDietTranslate(): ?string
    {
        return ToolsProvider::getKeyFromFlippedArray($this->diet, self::getTypeDiet());
    }

    /**
     * @param string $diet
     * @return \self
     * @throws \Exception
     */
    public function setDiet(?string $diet): self
    {
        if (!in_array($diet, self::getTypeDiet())) {
            throw new \Exception('Niewłaściwy rodzaj diety: ' . $diet);
        }
        $this->diet = $diet;

        return $this;
    }

    public function setUser(?User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

}
