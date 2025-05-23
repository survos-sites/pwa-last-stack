<?php

namespace App\Entity;

use App\Repository\PlanetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: PlanetRepository::class)]
class Planet
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue] // only for testing in VoyageControllerTest
    private ?int $id = null;

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @var TranslatableInterface<string>
     */
    #[ORM\Column(length: 255)]
    #[NotBlank]
//    #[Polyglot\Translatable]
//    #[ORM\Column(type: 'translatable_string')]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[NotBlank]
    private ?string $description = null;

    #[ORM\Column]
    #[NotBlank]
    #[GreaterThanOrEqual(0)]
    private ?float $lightYearsFromEarth = null;

    #[ORM\Column()]
    #[NotBlank]
    private ?string $imageFilename = null;

    #[ORM\Column]
    private bool $isInMilkyWay = true;

    #[ORM\OneToMany(mappedBy: 'planet', targetEntity: Voyage::class, orphanRemoval: true)]
    #[Polyglot\TranslationCollection]
    private Collection $voyages;

    #[ORM\Column(nullable: true)]
    private ?array $resized = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $imageCode = null;

    #[ORM\Column(length: 48, nullable: true)]
    private ?string $imageBlur = null;

    #[ORM\Column(length: 48, nullable: true)]
    private ?string $imagePath = null;

    public function __construct()
    {
        $this->voyages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name; // ->translate();
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLightYearsFromEarth(): ?float
    {
        return $this->lightYearsFromEarth;
    }

    public function setLightYearsFromEarth(?float $lightYearsFromEarth): static
    {
        $this->lightYearsFromEarth = $lightYearsFromEarth;

        return $this;
    }

    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }

    public function setImageFilename(?string $imageFilename): static
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }

    public function isInMilkyWay(): bool
    {
        return $this->isInMilkyWay;
    }

    public function setIsInMilkyWay(bool $isInMilkyWay): self
    {
        $this->isInMilkyWay = $isInMilkyWay;

        return $this;
    }

    public function getVoyageCount(): int
    {
        return $this->getVoyages()->count();
    }

    /**
     * @return Collection<int, Voyage>
     */
    public function getVoyages(): Collection
    {
        return $this->voyages;
    }

    public function addVoyage(Voyage $voyage): static
    {
        if (!$this->voyages->contains($voyage)) {
            $this->voyages->add($voyage);
            $voyage->setPlanet($this);
        }

        return $this;
    }

    public function removeVoyage(Voyage $voyage): static
    {
        if ($this->voyages->removeElement($voyage)) {
            // set the owning side to null (unless already changed)
            if ($voyage->getPlanet() === $this) {
                $voyage->setPlanet(null);
            }
        }

        return $this;
    }

    public function getResized(): ?array
    {
        return $this->resized;
    }

    public function setResized(?array $resized): static
    {
        $this->resized = $resized;

        return $this;
    }

    public function getImageCode(): ?string
    {
        return $this->imageCode;
    }

    public function setImageCode(?string $imageCode): static
    {
        $this->imageCode = $imageCode;

        return $this;
    }

    public function getImageBlur(): ?string
    {
        return $this->imageBlur;
    }

    public function setImageBlur(?string $imageBlur): static
    {
        $this->imageBlur = $imageBlur;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): static
    {
        $this->imagePath = $imagePath;

        return $this;
    }
}
