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
    protected $dateDeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date")
     * @Assert\Date
     * @Assert\GreaterThanOrEqual(
     *  propertyPath="dateDebut", message="La date du fin doit
     *  être supérieure à la date début")
     */
    protected $dateFin;

    /**
     *  @ORM\ManyToOne(targetEntity="RentBundle\Entity\Location",inversedBy="Reservation")
     * @ORM\JoinColumn(name="Id_location",referencedColumnName="id")
     */
    protected $id_L;


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
