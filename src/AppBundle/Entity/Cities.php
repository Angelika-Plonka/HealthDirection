<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cities
 *
 * @ORM\Table(name="cities")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CitiesRepository")
 */
class Cities
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
     * @ORM\Column(name="eagerToMeet", type="boolean")
     */
    private $eagerToMeet;

    /**
     *
     * @var User
     *
     * @ORM\OneToOne(targetEntity="User", inversedBy="region")
     *
     */

    private $user;

//    /**
//     *
//     * @var User
//     *
//     * @ORM\OneToOne(targetEntity="User", inversedBy="meeting")
//     *
//     */
//    private $client;


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
     * @return Cities
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
     * @return Cities
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
     * Set eagerToMeet
     *
     * @param boolean $eagerToMeet
     *
     * @return Cities
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

