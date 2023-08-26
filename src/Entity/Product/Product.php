<?php

namespace App\Entity\Product;

use App\DTO\Product\ProductPatchDTO;
use App\Entity\File;
use App\Repository\Product\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table(name: 'products')]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name;

    #[ORM\Column(type: Types::TEXT)]
    private string $description = "";

    #[ORM\Column(type: Types::DECIMAL)]
    private float $price;

    #[
        ORM\OneToOne(targetEntity: File::class, cascade: ['PERSIST'], orphanRemoval: true),
        ORM\JoinColumn(nullable: true, onDelete: 'SET NULL'),
    ]
    private ?File $bgImage = null;

    public function patch(ProductPatchDTO $patch): self
    {
        $bgImage = (function() use ($patch): ?File {
            if ($patch->getBgImage() == null) {
                return $this->bgImage;
            }

            return new File($patch->getBgImage());
        })();

        return $this
            ->setName($patch->getName() ?? $this->name)
            ->setDescription($patch->getDescription() ?? $this->description)
            ->setPrice($patch->getPrice() ?? $this->getPrice())
            ->setBgImage($bgImage)
        ;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getBgImage(): ?File
    {
        return $this->bgImage;
    }

    public function setBgImage(?File $bgImage): self
    {
        $this->bgImage = $bgImage;

        return $this;
    }
}
