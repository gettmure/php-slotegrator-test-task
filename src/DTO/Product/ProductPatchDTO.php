<?php

namespace App\DTO\Product;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductPatchDTO
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $description = null;
    private ?float $price = null;
    private ?UploadedFile $bgImage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getBgImage(): ?UploadedFile
    {
        return $this->bgImage;
    }

    public function setBgImage(?UploadedFile $bgImage): self
    {
        $this->bgImage = $bgImage;

        return $this;
    }
}
