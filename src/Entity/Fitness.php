<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FitnessRepository")
 */
class Fitness
{

    use ORMBehaviors\Timestampable\Timestampable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $weight;

    /**
     * @ORM\Column(type="integer")
     */
    private $waist;

    /**
     * @ORM\Column(type="integer")
     */
    private $hips;

    /**
     * @ORM\Column(type="integer")
     */
    private $belly;

    /**
     * @ORM\Column(type="integer")
     */
    private $bicep;

    /**
     * @ORM\Column(type="integer")
     */
    private $chest;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=true)
     */
    private $bmi;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dailyEnergyRequirements;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rightWeight;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=2, nullable=true)
     */
    private $whr;

    /**
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

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWaist(): ?int
    {
        return $this->waist;
    }

    public function setWaist(int $waist): self
    {
        $this->waist = $waist;

        return $this;
    }

    public function getHips(): ?int
    {
        return $this->hips;
    }

    public function setHips(int $hips): self
    {
        $this->hips = $hips;

        return $this;
    }

    public function getBelly(): ?int
    {
        return $this->belly;
    }

    public function setBelly(int $belly): self
    {
        $this->belly = $belly;

        return $this;
    }

    public function getBicep(): ?int
    {
        return $this->bicep;
    }

    public function setBicep(int $bicep): self
    {
        $this->bicep = $bicep;

        return $this;
    }

    public function getChest(): ?int
    {
        return $this->chest;
    }

    public function setChest(int $chest): self
    {
        $this->chest = $chest;

        return $this;
    }

    public function getBmi()
    {
        return $this->bmi;
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
