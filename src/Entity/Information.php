<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Information
 *
 * @ORM\Table(name="information")
 * @ORM\Entity(repositoryClass="App\Repository\InformationRepository")
 */
class Information
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
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50, nullable = false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="voivodeship", type="string", length=50, nullable = false)
     */
    private $voivodeship;

    /**
     * @var string
     *
     * @ORM\Column(name="eagerToWorkout", type="string")
     */
    private $eagerToWorkout;

    /**
     * @var string
     *
     * @ORM\Column(name="eagerToMeet", type="string")
     */
    private $eagerToMeet;

    /**
 * @var string
 *
 * @ORM\Column(name="eagerToDate", type="string")
 */
    private $eagerToDate;

    /**
     * @var string
     *
     * @ORM\Column(name="diet", type="string")
     */
    private $diet;

//    /**
//     *
//     * @var User
//     *
//     * @ORM\OneToOne(targetEntity="User", inversedBy="region")
//     *
//     */
//
//    private $user;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Information
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set voivodeship
     *
     * @param string $voivodeship
     *
     * @return Information
     */
    public function setVoivodeship($voivodeship)
    {
        $this->voivodeship = $voivodeship;

        return $this;
    }

    /**
     * Get voivodeship
     *
     * @return string
     */
    public function getVoivodeship()
    {
        return $this->voivodeship;
    }
    /**
     * Set eagerToWorkout
     *
     * @param string $eagerToWorkout
     *
     * @return Informatio
     */
    public function setEagerToWorkout($eagerToWorkout)
    {
        $this->eagerToWorkout = $eagerToWorkout;

        return $this;
    }

    /**
     * Get eagerToWorkout
     *
     * @return string
     */
    public function getEagerToWorkout()
    {
        return $this->eagerToWorkout;
    }

    /**
     * Set eagerToMeet
     *
     * @param string $eagerToMeet
     *
     * @return Information
     */
    public function setEagerToMeet($eagerToMeet)
    {
        $this->eagerToMeet = $eagerToMeet;

        return $this;
    }

    /**
     * Get eagerToMeet
     *
     * @return string
     */
    public function getEagerToMeet()
    {
        return $this->eagerToMeet;
    }

    /**
     * Set eagerToDate
     *
     * @param string $eagerToDate
     *
     * @return Information
     */
    public function setEagerToDate($eagerToDate)
    {
        $this->eagerToDate = $eagerToDate;

        return $this;
    }

    /**
     * Get eagerToDate
     *
     * @return string
     */
    public function getEagerToDate()
    {
        return $this->eagerToDate;
    }

    /**
     * Set diet
     *
     * @param string $diet
     *
     * @return Information
     */
    public function setDiet($diet)
    {
        $this->diet = $diet;

        return $this;
    }

    /**
     * Get diet
     *
     * @return string
     */
    public function getDiet()
    {
        return $this->diet;
    }

//    /**
//     * Set user
//     *
//     * @param $user
//     *
//     * @return $this
//     */
//
//    public function setUser(User $user) {
//
//        $this->user = $user;
//
//        return $this;
//    }
//
//    /**
//     * Get user
//     *
//     * @return User
//     */
//    public function getUser()
//    {
//        return $this->user;
//    }
}

