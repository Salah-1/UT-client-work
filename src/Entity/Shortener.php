<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShortenerRepository")
 */
class Shortener
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100,nullable=true)
     */
    private $original_url;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $shorten_link;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $redirect1;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $redirect2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginalUrl(): ?string
    {
        return $this->original_url;
    }

    public function setOriginalUrl(string $original_url): self
    {
        $this->original_url = $original_url;

        return $this;
    }

    public function getShortenLink(): ?string
    {
        return $this->shorten_link;
    }

    public function setShortenLink(?string $shorten_link): self
    {
        $this->shorten_link = $shorten_link;

        return $this;
    }

    public function getRedirect1(): ?string
    {
        return $this->redirect1;
    }

    public function setRedirect1(?string $redirect1): self
    {
        $this->redirect1 = $redirect1;

        return $this;
    }

    public function getRedirect2(): ?string
    {
        return $this->redirect2;
    }

    public function setRedirect2(?string $redirect2): self
    {
        $this->redirect2 = $redirect2;

        return $this;
    }
}
