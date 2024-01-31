<?php

namespace App\Entity;

use App\Repository\FollowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FollowRepository::class)]
class Follow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'followers', targetEntity: Usuario::class)]
    private Collection $user_following;

    #[ORM\OneToMany(mappedBy: 'following', targetEntity: Usuario::class)]
    private Collection $user_followed;

    public function __construct()
    {
        $this->user_following = new ArrayCollection();
        $this->user_followed = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Usuario>
     */
    public function getUserFollowing(): Collection
    {
        return $this->user_following;
    }

    public function addUserFollowing(Usuario $userFollowing): static
    {
        if (!$this->user_following->contains($userFollowing)) {
            $this->user_following->add($userFollowing);
            $userFollowing->setFollowers($this);
        }

        return $this;
    }

    public function removeUserFollowing(Usuario $userFollowing): static
    {
        if ($this->user_following->removeElement($userFollowing)) {
            // set the owning side to null (unless already changed)
            if ($userFollowing->getFollowers() === $this) {
                $userFollowing->setFollowers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Usuario>
     */
    public function getUserFollowed(): Collection
    {
        return $this->user_followed;
    }

    public function addUserFollowed(Usuario $userFollowed): static
    {
        if (!$this->user_followed->contains($userFollowed)) {
            $this->user_followed->add($userFollowed);
            $userFollowed->setFollowing($this);
        }

        return $this;
    }

    public function removeUserFollowed(Usuario $userFollowed): static
    {
        if ($this->user_followed->removeElement($userFollowed)) {
            // set the owning side to null (unless already changed)
            if ($userFollowed->getFollowing() === $this) {
                $userFollowed->setFollowing(null);
            }
        }

        return $this;
    }
}
