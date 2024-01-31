<?php

namespace App\Entity;

use App\Repository\LikedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikedRepository::class)]
class Liked
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'likes', targetEntity: Usuario::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'publication', targetEntity: Publications::class)]
    private Collection $likes;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->likes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $user->setLikes($this);
        }

        return $this;
    }

    public function removeUser(Usuario $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getLikes() === $this) {
                $user->setLikes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Publications>
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Publications $like): static
    {
        if (!$this->likes->contains($like)) {
            $this->likes->add($like);
            $like->setPublication($this);
        }

        return $this;
    }

    public function removeLike(Publications $like): static
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getPublication() === $this) {
                $like->setPublication(null);
            }
        }

        return $this;
    }
}
