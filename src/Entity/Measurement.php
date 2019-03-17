<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Measurement
 *
 * @ORM\Table(name="measurement")
 * @ORM\Entity(repositoryClass="App\Repository\MeasurementRepository")
 */
class Measurement
{

    use ORMBehaviors\Timestampable\Timestampable;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var float
     *
     * @ORM\Column(name="weight", type="float", nullable=true)
     */
    private $weight;
//
//    /**
//     * @var datetime
//     *
//     * @ORM\Column(name="date_added", type="datetime", options={"default"="CURRENT_TIMESTAMP"})
//     */
//    private $dateAdded;




    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer", nullable=true)
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer", nullable=true)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=255, nullable=true)
     */
    private $sex;

    /**
     * @var float
     *
     * @ORM\Column(name="waist", type="float", nullable=true)
     */
    private $waist;

    /**
     * @var float
     *
     * @ORM\Column(name="hips", type="float", nullable=true)
     */
    private $hips;

    /**
     * @var float
     *
     * @ORM\Column(name="belly", type="float", nullable=true)
     */
    private $belly;

    /**
     * @var float
     *
     * @ORM\Column(name="bmi", type="float", nullable=true)
     */
    private $bmi;

    /**
     * @var float
     *
     * @ORM\Column(name="activity", type="float", nullable=true)
     */
    private $activity;

    /**
     * @var int
     *
     * @ORM\Column(name="dailyEnergyRequirements", type="integer", nullable=true)
     */
    private $dailyEnergyRequirements;

    /**
     * @var float
     *
     * @ORM\Column(name="fat", type="float", nullable=true)
     */
    private $fat;

    /**
     * @var int
     *
     * @ORM\Column(name="bicep", type="integer", nullable=true)
     */
    private $bicep;

    /**
     * @var int
     *
     * @ORM\Column(name="chest", type="integer", nullable=true)
     */
    private $chest;

    /**
     * @var int
     *
     * @ORM\Column(name="rightWeight", type="integer", nullable=true)
     */
    private $rightWeight;

    /**
     * @var float
     *
     * @ORM\Column(name="whr", type="float", nullable=true)
     */
    private $whr;

    /**
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="measurement")
     *
     */

    private $person;


    /**
     * Get id
     *
     * @return integer
     */

    /**
     * Set weight
     *
     * @param float $weight
     * @return Measurement
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return Measurement
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return Measurement
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set sex
     *
     * @param string $sex
     * @return Measurement
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }


    /**
     * Set waist
     *
     * @param float $waist
     * @return Measurement
     */
    public function setWaist($waist)
    {
        $this->waist = $waist;

        return $this;
    }

    /**
     * Get waist
     *
     * @return float
     */
    public function getWaist()
    {
        return $this->waist;
    }

    /**
     * Set hips
     *
     * @param float $hips
     * @return Measurement
     */
    public function setHips($hips)
    {
        $this->hips = $hips;

        return $this;
    }

    /**
     * Get hips
     *
     * @return float
     */
    public function getHips()
    {
        return $this->hips;
    }

    /**
     * Set belly
     *
     * @param float $belly
     * @return Measurement
     */
    public function setBelly($belly)
    {
        $this->belly = $belly;

        return $this;
    }

    /**
     * Get belly
     *
     * @return float
     */
    public function getBelly()
    {
        return $this->belly;
    }

    /**
     * Set bmi
     *
     * @param float $bmi
     * @return Measurement
     */
    public function setBmi($bmi)
    {
        $this->bmi = $bmi;

        return $this;
    }

    /**
     * Get bmi
     *
     * @return float
     */
    public function getBmi()
    {
        return $this->bmi;
    }

    /**
     * Set activity
     *
     * @param float $activity
     * @return Measurement
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return float
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set dailyEnergyRequirements
     *
     * @param integer $dailyEnergyRequirements
     * @return Measurement
     */
    public function setDailyEnergyRequirements($dailyEnergyRequirements)
    {
        $this->dailyEnergyRequirements = $dailyEnergyRequirements;

        return $this;
    }

    /**
     * Get dailyEnergyRequirements
     *
     * @return integer
     */
    public function getDailyEnergyRequirements()
    {
        return $this->dailyEnergyRequirements;
    }

    /**
     * Set rightWeight
     *
     * @param integer $rightWeight
     * @return Measurement
     */
    public function setRightWeight($rightWeight)
    {
        $this->rightWeight = $rightWeight;
        return $this;
    }

    /**
     * Get rightWeight
     *
     * @return integer
     */
    public function getRightWeight()
    {
        return $this->rightWeight;
    }

    /**
     * Set person
     *
     * @param $person
     *
     * @return $this
     */
    public function setPerson(User $person) {

        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return User
     */
    public function getPerson()
    {
        return $this->person;
    }

//    /**
//     * Set dateAdded
//     *
//     * @param datetime $dateAdded
//     * @return Measurement
//     */
//    public function setDateAdded($dateAdded)
//    {
//        $this->dateAdded = $dateAdded;
//
//        return $this;
//    }
//
//    /**
//     * Get dateAdded
//     *
//     * @return datetime
//     */
//    public function getDateAdded()
//    {
//        return $this->dateAdded;
//    }

    /**
     * Set fat
     *
     * @param float $fat
     * @return Measurement
     */
    public function setFat($fat)
    {
        $this->fat = $fat;

        return $this;
    }

    /**
     * Get fat
     *
     * @return float
     */
    public function getFat()
    {
        return $this->fat;
    }

    /**
     * Set bicep
     *
     * @param integer $bicep
     * @return Measurement
     */
    public function setBicep($bicep)
    {
        $this->bicep = $bicep;

        return $this;
    }

    /**
     * Get bicep
     *
     * @return integer
     */
    public function getBicep()
    {
        return $this->bicep;
    }

    /**
     * Set chest
     *
     * @param integer $chest
     * @return Measurement
     */
    public function setChest($chest)
    {
        $this->chest = $chest;

        return $this;
    }

    /**
     * Get chest
     *
     * @return integer
     */
    public function getChest()
    {
        return $this->chest;
    }

    /**
     * Set whr
     *
     * @param float $whr
     * @return Measurement
     */
    public function setWhr($whr)
    {
        $this->whr = $whr;

        return $this;
    }

    /**
     * Get whr
     *
     * @return float
     */
    public function getWhr()
    {
        return $this->whr;
    }
}