<?php

namespace RentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Circuit
 *
 * @ORM\Table(name="circuit")
 * @ORM\Entity
 */
class Circuit
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_C", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idC;

    /**
     * @var integer
     *
     * @ORM\Column(name="name", type="integer", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="begin", type="string", length=20, nullable=false)
     */
    private $begin;

    /**
     * @var string
     *
     * @ORM\Column(name="end", type="string", length=20, nullable=false)
     */
    private $end;

    /**
     * @var string
     *
     * @ORM\Column(name="pause", type="string", length=20, nullable=false)
     */
    private $pause;

    /**
     * @var float
     *
     * @ORM\Column(name="distance", type="float", precision=10, scale=0, nullable=false)
     */
    private $distance;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=false)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="difficulty", type="string", length=50, nullable=false)
     */
    private $difficulty;


}

