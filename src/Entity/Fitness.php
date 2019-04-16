<?php

namespace App\Entity;

use App\Entity\User;
use App\Service\ToolsProvider;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FitnessRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Fitness
{

    use ORMBehaviors\Timestampable\Timestampable;

    /**
     * ACTIVITY SCALE
     */
    const ACTIVITY_SCALE_1 = '1.4';
    const ACTIVITY_SCALE_2 = '1.75';
    const ACTIVITY_SCALE_3 = '2';
    const ACTIVITY_SCALE_4 = '2.2';
    const ACTIVITY_SCALE_5 = '2.4';

    public static function getTypeActivity(): array
    {
        return [
            'fitness.activity.scale_1' => self::ACTIVITY_SCALE_1,
            'fitness.activity.scale_2' => self::ACTIVITY_SCALE_2,
            'fitness.activity.scale_3' => self::ACTIVITY_SCALE_3,
            'fitness.activity.scale_4' => self::ACTIVITY_SCALE_4,
            'fitness.activity.scale_5' => self::ACTIVITY_SCALE_5
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
     * @ORM\Column(type="string", length=5, nullable=true)
     * @Assert\Choice(callback="getTypeActivity", message="message.wrong_choice")
     */
    private $activity;

    /**
     * @var number
     *
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * @Assert\NotBlank()
     * @Assert\Range(min=10, max=300)
     */
    private $weight;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Range(min=100, max=230)
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $waist;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hips;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $belly;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bicep;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $chest;

    /**
     * @var number
     *
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=true)
     */
    private $bmi;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dailyEnergyRequirements;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rightWeight;

    /**
     * @var number
     *
     * @ORM\Column(type="decimal", precision=3, scale=2, nullable=true)
     */
    private $whr;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="fitnessMeasurements")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     * @Assert\NotBlank()
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
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

    public function getWaist(): ?int
    {
        return $this->waist;
    }

    public function setWaist(?int $waist): self
    {
        $this->waist = $waist;

        return $this;
    }

    public function getHips(): ?int
    {
        return $this->hips;
    }

    public function setHips(?int $hips): self
    {
        $this->hips = $hips;

        return $this;
    }

    public function getBelly(): ?int
    {
        return $this->belly;
    }

    public function setBelly(?int $belly): self
    {
        $this->belly = $belly;

        return $this;
    }

    public function getBicep(): ?int
    {
        return $this->bicep;
    }

    public function setBicep(?int $bicep): self
    {
        $this->bicep = $bicep;

        return $this;
    }

    public function getChest(): ?int
    {
        return $this->chest;
    }

    public function setChest(?int $chest): self
    {
        $this->chest = $chest;

        return $this;
    }

    public function getBmi(): ?float
    {
        return null !== $this->bmi ? round($this->bmi, 2) : null;
    }

    public function setBmi($bmi): self
    {
        $this->bmi = $bmi;

        return $this;
    }

    public function getDailyEnergyRequirements(): ?int
    {
        return $this->dailyEnergyRequirements;
    }

    public function setDailyEnergyRequirements(?int $dailyEnergyRequirements): self
    {
        $this->dailyEnergyRequirements = $dailyEnergyRequirements;

        return $this;
    }

    public function getRightWeight(): ?int
    {
        return $this->rightWeight;
    }

    public function setRightWeight(?int $rightWeight): self
    {
        $this->rightWeight = $rightWeight;

        return $this;
    }

    public function getWhr()
    {
        return $this->whr;
    }

    public function setWhr($whr): self
    {
        $this->whr = $whr;

        return $this;
    }

    public function getFat(): ?int
    {
        return $this->fat;
    }

    public function setFat(?int $fat): self
    {
        $this->fat = $fat;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

}
