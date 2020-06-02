<?php

namespace RentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="fk_location", columns={"id"}), @ORM\Index(name="fk_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var int
     *
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=20, nullable=false)
     */
    protected $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeb", type="date", nullable=false)
     * @Assert\Date
     * @Assert\GreaterThanOrEqual("today")
     */
    protected $dateDeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date")
     * @Assert\Date
     * @Assert\GreaterThanOrEqual(
     *  propertyPath="dateDeb", message="La date du fin doit
     *  être supérieure à la date début")
     */
    protected $dateFin;

    /**
     *  @ORM\ManyToOne(targetEntity="RentBundle\Entity\Location")
     * @ORM\JoinColumn(name="id_location",referencedColumnName="id")
     */
    protected $location;

    /**
     *  @ORM\ManyToOne(targetEntity="RentBundle\Entity\FosUser")
     * @ORM\JoinColumn(name="id_user",referencedColumnName="id")
     */
    protected $user;


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
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }


    /**
     * Set dateDeb
     *
     * @param DateTime $dateDeb
     *
     * @return Reservation
     */
    public function setDateDeb($dateDeb)
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    /**
     * Get dateDeb
     *
     * @return DateTime
     */
    public function getDateDeb()
    {
        return $this->dateDeb;
    }

    /**
     * Set dateFin
     *
     * @param DateTime $dateFin
     *
     * @return Reservation
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }




    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

}
