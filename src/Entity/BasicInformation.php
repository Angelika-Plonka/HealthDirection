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
     * @var string
     *
     * @ORM\Column(type="string", length=1)
     * @Assert\Choice(callback="getTypeOfSex", message="message.wrong_choice")
     * @Assert\NotBlank()
     */
    private $sex;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     * @Assert\Date()
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = "-110 years",
     *      max = "-5 years",
     * 		minMessage = "You must be less than 110 years old.",
     * 		maxMessage = "You must be at least 10 years old."
     * )
     */
    private $birthday;

    /**
     * @var string
     * 
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
