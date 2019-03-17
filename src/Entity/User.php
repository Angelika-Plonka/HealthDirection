<?php

namespace App\Entity;

use App\Entity\Fitness;
use App\Entity\Location;
use FOS\UserBundle\Model\User as BaseUser;
use App\Entity\BasicInformation;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(max=50)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(max=50)
     */
    private $lastName;


//    /**
//     *
//     * @var Information
//     *
//     * @ORM\OneToOne(targetEntity="Information", mappedBy="user")
//     *
//     */
//    private $region;

    /**
     * @ORM\OneToOne(targetEntity="BasicInformation", mappedBy="user", cascade={"all"})
     * @Assert\Valid()
     */
    private $basicInformation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Fitness", mappedBy="user", cascade={"all"})
     */
    private $fitnessMeasurements;

    /**
     * @ORM\OneToOne(targetEntity="Location", mappedBy="user", cascade={"all"})
     * @Assert\Valid()
     */
    private $location;

    public function __construct()
    {
        parent::__construct();
        $this->fitnessMeasurements = new ArrayCollection();
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBasicInformation(): ?BasicInformation
    {
        return $this->basicInformation;
    }

    public function setBasicInformation(?BasicInformation $basicInformation): self
    {
        $this->basicInformation = $basicInformation;

        return $this;
    }

    public function getFitnessMeasurements(): Collection
    {
        return $this->fitnessMeasurements;
    }

    public function addFitness(Fitness $fitness): self
    {
        if (!$this->fitnessMeasurements->contains($fitness)) {
            $this->fitnessMeasurements[] = $fitness;
            $fitness->setUser($this);
        }

        return $this;
    }

    public function removeFitness(Fitness $fitness): self
    {
        if ($this->fitnessMeasurements->contains($fitness)) {
            $this->fitnessMeasurements->removeElement($fitness);
            // set the owning side to null (unless already changed)
            if ($fitness->getUser() === $this) {
                $fitness->setUser(null);
            }
        }

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

}
