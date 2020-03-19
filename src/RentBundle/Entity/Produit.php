<?php

namespace RentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_P", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idP;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_P", type="string", length=30, nullable=false)
     */
    private $nomP;

    /**
     * @var string
     *
     * @ORM\Column(name="type_P", type="string", length=20, nullable=false)
     */
    private $typeP;

    /**
     * @var string
     *
     * @ORM\Column(name="marque_P", type="string", length=20, nullable=false)
     */
    private $marqueP;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie_P", type="string", length=20, nullable=false)
     */
    private $categorieP;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur_P", type="string", length=20, nullable=false)
     */
    private $couleurP;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_P", type="string", length=10, nullable=false)
     */
    private $photoP;


}

