<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1000)]
    private ?string $message = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $file = null;

    #[ORM\Column]
    private ?bool $leido = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\OneToMany(mappedBy: 'emitter', targetEntity: Usuario::class)]
    private Collection $emitter;

    #[ORM\OneToMany(mappedBy: 'received', targetEntity: Usuario::class)]
    private Collection $receiver;

    public function __construct()
    {
        $this->emitter = new ArrayCollection();
        $this->receiver = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): static
    {
        $this->file = $file;

        return $this;
    }

    public function isLeido(): ?bool
    {
        return $this->leido;
    }

    public function setLeido(bool $leido): static
    {
        $this->leido = $leido;

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
    public function getEmitter(): Collection
    {
        return $this->emitter;
    }

    public function addEmitter(Usuario $emitter): static
    {
        if (!$this->emitter->contains($emitter)) {
            $this->emitter->add($emitter);
            $emitter->setEmitter($this);
        }

        return $this;
    }

    public function removeEmitter(Usuario $emitter): static
    {
        if ($this->emitter->removeElement($emitter)) {
            // set the owning side to null (unless already changed)
            if ($emitter->getEmitter() === $this) {
                $emitter->setEmitter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Usuario>
     */
    public function getReceiver(): Collection
    {
        return $this->receiver;
    }

    public function addReceiver(Usuario $receiver): static
    {
        if (!$this->receiver->contains($receiver)) {
            $this->receiver->add($receiver);
            $receiver->setReceived($this);
        }

        return $this;
    }

    public function removeReceiver(Usuario $receiver): static
    {
        if ($this->receiver->removeElement($receiver)) {
            // set the owning side to null (unless already changed)
            if ($receiver->getReceived() === $this) {
                $receiver->setReceived(null);
            }
        }

        return $this;
    }
}
