<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * Categories
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriesRepository")
 */
class Categories
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $uid;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $has_taxes = false;

    /**
     * Get uid.
     *
     * @return uuid
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Categories
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set hasTaxes.
     *
     * @param bool $hasTaxes
     *
     * @return Categories
     */
    public function setHasTaxes($hasTaxes)
    {
        $this->has_taxes = $hasTaxes;

        return $this;
    }

    /**
     * Get hasTaxes.
     *
     * @return bool
     */
    public function getHasTaxes()
    {
        return $this->has_taxes;
    }
}
