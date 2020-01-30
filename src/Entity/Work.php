<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkRepository")
 */
class Work
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $creator;

    /**
     * @ORM\Column(type="integer")
     */
    private $releaseDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="work")
     */
    private $reviews;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArtType", inversedBy="works")
     */
    private $artType;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ArtGenre", mappedBy="works")
     */
    private $artGenres;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Actor", mappedBy="works")
     */
    private $actors;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->artGenres = new ArrayCollection();
        $this->actors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreator(): ?string
    {
        return $this->creator;
    }

    public function setCreator(string $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    public function getReleaseDate(): ?int
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(int $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * @return Collection|Review[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setWork($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->contains($relivreview)) {
            $this->reviews->removeElement($review);
            // set the owning side to null (unless already changed)
            if ($review->getWork() === $this) {
                $review->setWork(null);
            }
        }

        return $this;
    }

    public function getArtType(): ?ArtType
    {
        return $this->artType;
    }

    public function setArtType(?ArtType $artType): self
    {
        $this->artType = $artType;

        return $this;
    }

    /**
     * @return Collection|ArtGenre[]
     */
    public function getArtGenres(): Collection
    {
        return $this->artGenres;
    }

    public function addArtGenre(ArtGenre $artGenre): self
    {
        if (!$this->artGenres->contains($artGenre)) {
            $this->artGenres[] = $artGenre;
            $artGenre->addWork($this);
        }

        return $this;
    }

    public function removeArtGenre(ArtGenre $artGenre): self
    {
        if ($this->artGenres->contains($artGenre)) {
            $this->artGenres->removeElement($artGenre);
            $artGenre->removeWork($this);
        }

        return $this;
    }

    /**
     * @return Collection|Actor[]
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Actor $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
            $actor->addWork($this);
        }

        return $this;
    }

    public function removeActor(Actor $actor): self
    {
        if ($this->actors->contains($actor)) {
            $this->actors->removeElement($actor);
            $actor->removeWork($this);
        }

        return $this;
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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }
}
