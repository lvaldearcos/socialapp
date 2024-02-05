<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Usuario implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $role = null;

    #[ORM\Column(length: 150)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100)]
    private ?string $last_name = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 100)]
    private ?string $passw = null;

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column(length: 500)]
    private ?string $description = null;

    #[ORM\Column(length: 500)]
    private ?string $image = null;

    #[ORM\Column(type:"json")]
    private $roles = [];

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Publications $publications = null;

    #[ORM\ManyToOne(inversedBy: 'user_following')]
    private ?Follow $followers = null;

    #[ORM\ManyToOne(inversedBy: 'user_followed')]
    private ?Follow $following = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Liked $likes = null;

    #[ORM\ManyToOne(inversedBy: 'emitter')]
    private ?Message $emitter = null;

    #[ORM\ManyToOne(inversedBy: 'receiver')]
    private ?Message $received = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Notification $notifications = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassw(): ?string
    {
        return $this->passw;
    }

    public function setPassw(string $passw): static
    {
        $this->passw = $passw;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
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

    public function getPublications(): ?Publications
    {
        return $this->publications;
    }

    public function setPublications(?Publications $publications): static
    {
        $this->publications = $publications;

        return $this;
    }

    public function getFollowers(): ?Follow
    {
        return $this->followers;
    }

    public function setFollowers(?Follow $followers): static
    {
        $this->followers = $followers;

        return $this;
    }

    public function getFollowing(): ?Follow
    {
        return $this->following;
    }

    public function setFollowing(?Follow $following): static
    {
        $this->following = $following;

        return $this;
    }

    public function getLikes(): ?Liked
    {
        return $this->likes;
    }

    public function setLikes(?Liked $likes): static
    {
        $this->likes = $likes;

        return $this;
    }

    public function getEmitter(): ?Message
    {
        return $this->emitter;
    }

    public function setEmitter(?Message $emitter): static
    {
        $this->emitter = $emitter;

        return $this;
    }

    public function getReceived(): ?Message
    {
        return $this->received;
    }

    public function setReceived(?Message $received): static
    {
        $this->received = $received;

        return $this;
    }

    public function getNotifications(): ?Notification
    {
        return $this->notifications;
    }

    public function setNotifications(?Notification $notifications): static
    {
        $this->notifications = $notifications;

        return $this;
    }

    public function getRoles(): array
    {
     $roles = $this->roles;
     $roles[] = 'ROLE_USER';

     return array_unique($roles);
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        // TODO: Implement getUserIdentifier() method.
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
