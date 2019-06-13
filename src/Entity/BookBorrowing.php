<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookBorrowingRepository")
 */
class BookBorrowing
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userEmail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bookIsbn;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\LibraryCard", inversedBy="borrowings")
     */
    private $libraryCard;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserEmail(): ?string
    {
        return $this->userEmail;
    }

    public function setUserEmail(string $userEmail): self
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    public function getBookIsbn(): ?string
    {
        return $this->bookIsbn;
    }

    public function setBookIsbn(string $bookIsbn): self
    {
        $this->bookIsbn = $bookIsbn;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getLibraryCard(): ?LibraryCard
    {
        return $this->libraryCard;
    }

    public function setLibraryCard(?LibraryCard $libraryCard): self
    {
        $this->libraryCard = $libraryCard;

        return $this;
    }
}
