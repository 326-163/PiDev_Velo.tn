<?php

namespace RentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="fk_location", columns={"id"}), @ORM\Index(name="fk_user", columns={"id_U"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeb", type="date", nullable=false)
     * @Assert\Date
     * @Assert\GreaterThanOrEqual("today")
     */
    private $dateDeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date")
     * @Assert\Date
     * @Assert\GreaterThanOrEqual(
     *     propertyPath="dateDebut", message="La date du fin doit
     *     être supérieure à la date début")
     */
    private $dateFin;

    

    /**
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumn(name="id_Location"
     * ,referencedColumnName="id")
     */
    private $id_Location;

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
     * Set dateDeb
     *
     * @param DateTime $dateDeb
     *
     * @return Location
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
     * @return Location
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
     * @var integer
     *
     * @ORM\Column(name="id_U", type="integer", nullable=false)
     */
    private $idU;
    
  

    /**
     * @return mixed
     */
    public function getIdLocation()
    {
        return $this->id_Location;
    }

    /**
     * @param mixed $id_Location
     */
    public function setIdLocation($id_Location)
    {
        $this->id_Location = $id_Location;
    }

}

