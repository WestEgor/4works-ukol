<?php

namespace Model;

class Category extends DomainObject
{
    private ?int $id;

    private ?string $categoryName;

    /**
     * Category constructor.
     *
     * @param int|null    $id
     * @param string|null $name
     */
    public function __construct(
        ?int $id = null,
        ?string $name = null
    ) {
        $this->id = $id;
        $this->categoryName = $name;
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
    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    /**
     * @param string $categoryName
     */
    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }
}
