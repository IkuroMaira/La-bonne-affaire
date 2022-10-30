<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity('title', message: 'Cette annonce existe déjà.')]
class Product
{
    // Pour mettre en place plus tard la possibilité de gérer des annonces en brouillon
//    const STATUS = ['DRAFT_STATUS', 'PUBLISHED_STATUS'];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string',length: 155, unique: true)]
    #[Assert\Length(min: 10, max: 155)]
    #[Assert\NotBlank]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\NotBlank]
    private ?float $price = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?\DateTimeImmutable $createdAt;

    #[ORM\Column(nullable: true)]
    #[Assert\NotNull]
    private ?\DateTimeImmutable $updatedAt;

    #[ORM\Column(nullable: true)]
    private ?int $authorID = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isFavorite = null;

    #[ORM\Column(nullable: true)]
    private array $address = [];

    #[ORM\Column(nullable: true)]
    private array $photos = [];

    #[ORM\Column(nullable: true)]
    private ?bool $isSold = null;

    #[ORM\Column(length: 55, nullable: true)]
    private ?string $category = null;

//    #[ORM\Column(type: 'string', length: 55)]
//    private string $status = Product::STATUS[0];

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function preUpdate()
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function __toString()
    {
        return $this->title;
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

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAuthorID(): ?int
    {
        return $this->authorID;
    }

    public function setAuthorID(?int $authorID): self
    {
        $this->authorID = $authorID;

        return $this;
    }

    public function isIsFavorite(): ?bool
    {
        return $this->isFavorite;
    }

    public function setIsFavorite(?bool $isFavorite): self
    {
        $this->isFavorite = $isFavorite;

        return $this;
    }

    public function getAddress(): array
    {
        return $this->address;
    }

    public function setAddress(?array $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function setPhotos(?array $photos): self
    {
        $this->photos = $photos;

        return $this;
    }

    public function isIsSold(): ?bool
    {
        return $this->isSold;
    }

    public function setIsSold(?bool $isSold): self
    {
        $this->isSold = $isSold;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

//    public function getStatus(): ?string
//    {
//        return $this->status;
//    }
//
//    public function setStatus(string $status): self
//    {
//        $this->status = $status;
//
//        return $this;
//    }
}
