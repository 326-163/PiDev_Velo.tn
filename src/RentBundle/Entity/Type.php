<?php

namespace RentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type
 *
 * @ORM\Table(name="type", indexes={@ORM\Index(name="fk_idA", columns={"id_A"})})
 * @ORM\Entity
 */
class Type
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_T", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idT;

    /**
     * @var boolean
     *
     * @ORM\Column(name="achat", type="boolean", nullable=true)
     */
    private $achat;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vente", type="boolean", nullable=true)
     */
    private $vente;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_A", type="integer", nullable=true)
     */
    private $idA;


}

