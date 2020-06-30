<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SkillRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     shortName="skills",
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get", "put"},
 *     normalizationContext={"groups"={"skills:read"}},
 *     denormalizationContext={"groups"={"skills:write"}}
 * )
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 */
class Skill
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"skills:read", "skills:write"})
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=2,
     *     max=50,
     *     maxMessage="Label your skill in 50 chars or less"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"skills:read", "skills:write"})
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"skills:read", "skills:write"})
     * @Assert\NotBlank()
     * @Assert\GreaterThan(
     *     value = -1
     * )
     */
    private $quantity;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    // server should set it automatically
    public function __construct(string $title = null)
    {
        $this->title = $title;
        $this->createdAt = new \DateTimeImmutable();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }
}
