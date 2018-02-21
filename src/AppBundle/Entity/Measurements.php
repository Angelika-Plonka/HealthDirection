<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Measurements
 *
 * @ORM\Table(name="measurements")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MeasurementsRepository")
 */
class Measurements
{

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
     * @var int
     *
     * @ORM\Column(name="activity", type="integer", nullable=true)
     */
    private $activity;

    /**
     * @var int
     *
     * @ORM\Column(name="dailyEnergyRequirements", type="integer", nullable=true)
     */
    private $dailyEnergyRequirements;

    /**
     * @var int
     *
     * @ORM\Column(name="rightWeight", type="integer", nullable=true)
     */
    private $rightWeight;

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
     * @return Measurements
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
     * @return Measurements
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
     * @return Measurements
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
     * @return Measurements
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
     * @return Measurements
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
     * @return Measurements
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
     * @return Measurements
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
     * @return Measurements
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
     * @param integer $activity
     * @return Measurements
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return integer
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set dailyEnergyRequirements
     *
     * @param integer $dailyEnergyRequirements
     * @return Measurements
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
     * @return Measurements
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
}