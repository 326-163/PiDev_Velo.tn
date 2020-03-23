<?php

namespace RentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="fk_location", columns={"id_L"}), @ORM\Index(name="fk_user", columns={"id_U"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_R", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idR;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=20, nullable=false)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeb", type="date", nullable=false)
     */
    private $datedeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date", nullable=false)
     */
    private $datefin;

    

    /**
     * @var integer
     *
     * @ORM\Column(name="id_U", type="integer", nullable=false)
     */
    private $idU;
    
    /**
     * @ORM\ManyToOne(targetEntity="RentBundle\Entity\Location", inversedBy="Reservation")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $id;

}

