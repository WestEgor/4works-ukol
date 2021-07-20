<?php

namespace Model;

class Product extends DomainObject
{
    private ?int $id;

    private ?string $productName;

    private ?int $categoryId;

    private ?float $price;

    private ?float $quantity;

    private ?string $description;

    /**
     * Product constructor.
     *
     * @param int|null $id
     * @param string|null $productName
     * @param int|null $categoryId
     * @param float|null $price
     * @param float|null $quantity
     * @param string|null $description
     */
    public function __construct(
        ?int $id = null,
        ?string $productName = null,
        ?int $categoryId = null,
        ?float $price = null,
        ?float $quantity = null,
        ?string $description = null
    )
    {
        $this->id = $id;
        $this->productName = $productName;
        $this->categoryId = $categoryId;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     */
    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     */
    public function setQuantity(float $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
