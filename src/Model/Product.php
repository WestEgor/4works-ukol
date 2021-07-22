<?php

namespace Model;

class Product extends DomainObject
{
    private ?int $id;

    private ?string $productName;

    private ?Category $category;

    private ?float $price;

    private ?float $quantity;

    private ?string $description;

    /**
     * Product constructor.
     *
     * @param int|null $id
     * @param string|null $productName
     * @param Category|null $category
     * @param float|null $price
     * @param float|null $quantity
     * @param string|null $description
     */
    public function __construct(
        ?int $id = null,
        ?string $productName = null,
        ?Category $category = null,
        ?float $price = null,
        ?float $quantity = null,
        ?string $description = null
    )
    {
        $this->id = $id;
        $this->productName = $productName;
        $this->category = $category;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->description = $description;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
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
     * @return string|null
     */
    public function getProductName(): ?string
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
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
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
     * @return float|null
     */
    public function getQuantity(): ?float
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
     * @return string|null
     */
    public function getDescription(): ?string
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
