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
     * @ORM\Column(name="city", type="string", length=50)
     */
    private $city;

    /**
     * @var bool
     *
     * @ORM\Column(name="eagerToMeet", type="boolean")
     */
    private $eagerToMeet;


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
}

