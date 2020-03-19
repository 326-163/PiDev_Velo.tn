<?php

namespace RentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="fk_idE", columns={"id_E"}), @ORM\Index(name="fk_idU", columns={"id_U"})})
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Pa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPa;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr", type="integer", nullable=true)
     */
    private $nbr;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_E", type="integer", nullable=true)
     */
    private $idE;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_U", type="integer", nullable=true)
     */
    private $idU;


}

