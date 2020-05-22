<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * Products
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductsRepository")
 */
class Products
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShoppingBaskets")
     * @ORM\JoinColumn(name="basket_uid", referencedColumnName="uid")
     */
    private $basket_uid;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categories")
     * @ORM\JoinColumn(name="category_uid", referencedColumnName="uid")
     */
    private $category_uid;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $shelf_price;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $taxes5 = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $taxes10 = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $row_amount;


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
     * @return Products
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
     * Set quantity.
     *
     * @param int $quantity
     *
     * @return Products
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity.
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set shelfPrice.
     *
     * @param string $shelfPrice
     *
     * @return Products
     */
    public function setShelfPrice($shelfPrice)
    {
        $this->shelf_price = $shelfPrice;

        return $this;
    }

    /**
     * Get shelfPrice.
     *
     * @return string
     */
    public function getShelfPrice()
    {
        return $this->shelf_price;
    }

    /**
     * Set taxes5.
     *
     * @param bool $taxes5
     *
     * @return Products
     */
    public function setTaxes5($taxes5)
    {
        $this->taxes5 = $taxes5;

        return $this;
    }

    /**
     * Get taxes5.
     *
     * @return bool
     */
    public function getTaxes5()
    {
        return $this->taxes5;
    }

    /**
     * Set taxes10.
     *
     * @param bool $taxes10
     *
     * @return Products
     */
    public function setTaxes10($taxes10)
    {
        $this->taxes10 = $taxes10;

        return $this;
    }

    /**
     * Get taxes10.
     *
     * @return bool
     */
    public function getTaxes10()
    {
        return $this->taxes10;
    }

    /**
     * Set rowAmount.
     *
     * @param string $rowAmount
     *
     * @return Products
     */
    public function setRowAmount($rowAmount)
    {
        $this->row_amount = $rowAmount;

        return $this;
    }

    /**
     * Get rowAmount.
     *
     * @return string
     */
    public function getRowAmount()
    {
        return $this->row_amount;
    }

    /**
     * Set basketUid.
     *
     * @param \AppBundle\Entity\ShoppingBaskets|null $basketUid
     *
     * @return Products
     */
    public function setBasketUid(\AppBundle\Entity\ShoppingBaskets $basketUid = null)
    {
        $this->basket_uid = $basketUid;

        return $this;
    }

    /**
     * Get basketUid.
     *
     * @return \AppBundle\Entity\ShoppingBaskets|null
     */
    public function getBasketUid()
    {
        return $this->basket_uid;
    }

    /**
     * Set categoryUid.
     *
     * @param \AppBundle\Entity\Categories|null $categoryUid
     *
     * @return Products
     */
    public function setCategoryUid(\AppBundle\Entity\Categories $categoryUid = null)
    {
        $this->category_uid = $categoryUid;

        return $this;
    }

    /**
     * Get categoryUid.
     *
     * @return \AppBundle\Entity\Categories|null
     */
    public function getCategoryUid()
    {
        return $this->category_uid;
    }
}
