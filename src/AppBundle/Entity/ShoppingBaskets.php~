<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * ShoppingBaskets
 *
 * @ORM\Table(name="shopping_baskets")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShoppingBasketsRepository")
 */
class ShoppingBaskets
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
    private $name;

    

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
     * Set name.
     *
     * @param string $name
     *
     * @return ShoppingBaskets
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
