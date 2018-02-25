<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Informations
 *
 * @ORM\Table(name="informations")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InformationsRepository")
 */
class Informations
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
     * @var bool
     *
     * @ORM\Column(name="eagerToWorkout", type="boolean")
     */
    private $eagerToWorkout;

    /**
     * @var bool
     *
     * @ORM\Column(name="eagerToMeet", type="boolean")
     */
    private $eagerToMeet;

    /**
     * @var bool
     *
     * @ORM\Column(name="eagerToDate", type="boolean")
     */
    private $eagerToDate;

    /**
     *
     * @var User
     *
     * @ORM\OneToOne(targetEntity="User", inversedBy="region")
     *
     */

    private $user;


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
     * @return Informations
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
     * @return Informations
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
     * @param boolean $eagerToWorkout
     *
     * @return Informations
     */
    public function setEagerToWorkout($eagerToWorkout)
    {
        $this->eagerToWorkout = $eagerToWorkout;

        return $this;
    }

    /**
     * Get eagerToWorkout
     *
     * @return bool
     */
    public function getEagerToWorkout()
    {
        return $this->eagerToWorkout;
    }

    /**
     * Set eagerToMeet
     *
     * @param boolean $eagerToMeet
     *
     * @return Informations
     */
    public function setEagerToMeet($eagerToMeet)
    {
        $this->eagerToMeet = $eagerToMeet;

        return $this;
    }

    /**
     * Get eagerToMeet
     *
     * @return bool
     */
    public function getEagerToMeet()
    {
        return $this->eagerToMeet;
    }

    /**
     * Set eagerToDate
     *
     * @param boolean $eagerToDate
     *
     * @return Informations
     */
    public function setEagerToDate($eagerToDate)
    {
        $this->eagerToDate = $eagerToDate;

        return $this;
    }

    /**
     * Get eagerToDate
     *
     * @return bool
     */
    public function getEagerToDate()
    {
        return $this->eagerToDate;
    }

    /**
     * Set user
     *
     * @param $user
     *
     * @return $this
     */

    public function setUser(User $user) {

        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}

