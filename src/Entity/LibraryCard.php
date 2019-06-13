<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LibraryCardRepository")
 */
class LibraryCard
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
     * @ORM\OneToMany(targetEntity="App\Entity\BookBorrowing", mappedBy="libraryCard")
     */
    private $borrowings;

    public function __construct()
    {
        $this->borrowings = new ArrayCollection();
    }

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

    /**
     * @return Collection|BookBorrowing[]
     */
    public function getBorrowings(): Collection
    {
        return $this->borrowings;
    }

    public function addBorrowing(BookBorrowing $borrowing): self
    {
        if (!$this->borrowings->contains($borrowing)) {
            $this->borrowings[] = $borrowing;
            $borrowing->setLibraryCard($this);
        }

        return $this;
    }

    public function removeBorrowing(BookBorrowing $borrowing): self
    {
        if ($this->borrowings->contains($borrowing)) {
            $this->borrowings->removeElement($borrowing);
            // set the owning side to null (unless already changed)
            if ($borrowing->getLibraryCard() === $this) {
                $borrowing->setLibraryCard(null);
            }
        }

        return $this;
    }
}
