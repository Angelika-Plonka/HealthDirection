<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
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
     *
     * @var Measurements|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Measurements", mappedBy="person")
     *
     */
    private $measurement;


    /**
     *
     * @var Informations
     *
     * @ORM\OneToOne(targetEntity="Informations", mappedBy="user")
     *
     */
    private $region;


    public function __construct() {
        parent::__construct();
        $this->measurement = new \Doctrine\Common\Collections\ArrayCollection();
    }

}