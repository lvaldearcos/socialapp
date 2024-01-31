<?php

namespace App\Entity;

use App\Repository\PublicationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublicationsRepository::class)]
class Publications
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $description = null;

    #[ORM\Column(length: 500)]
    private ?string $image = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\OneToMany(mappedBy: 'publications', targetEntity: Usuario::class)]
    private Collection $users;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    private ?Liked $publication = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, Usuario>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Usuario $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setPublications($this);
        }

        return $this;
    }

    public function removeUser(Usuario $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getPublications() === $this) {
                $user->setPublications(null);
            }
        }

        return $this;
    }

    public function getPublication(): ?Liked
    {
        return $this->publication;
    }

    public function setPublication(?Liked $publication): static
    {
        $this->publication = $publication;

        return $this;
    }
}
