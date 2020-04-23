<?php

namespace RentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventEntity
 *
 * @ORM\Table(name="event_entity")
 * @ORM\Entity
 */
class EventEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="bg_color", type="string", length=255, nullable=false)
     */
    private $bgColor;

    /**
     * @var string
     *
     * @ORM\Column(name="fg_color", type="string", length=255, nullable=false)
     */
    private $fgColor;

    /**
     * @var string
     *
     * @ORM\Column(name="css_class", type="string", length=255, nullable=false)
     */
    private $cssClass;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_datetime", type="datetime", nullable=false)
     */
    private $startDatetime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_datetime", type="datetime", nullable=false)
     */
    private $endDatetime;

    /**
     * @var boolean
     *
     * @ORM\Column(name="all_day", type="boolean", nullable=true)
     */
    private $allDay;

    /**
     * @var array
     *
     * @ORM\Column(name="other_fields", type="array", nullable=false)
     */
    private $otherFields;


}

