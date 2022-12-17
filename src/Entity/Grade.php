<?php

namespace App\Entity;

use App\Repository\GradeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GradeRepository::class)]
class Grade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $score = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $student = [];

    #[ORM\Column(type: Types::ARRAY)]
    private array $class = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getStudent(): array
    {
        return $this->student;
    }

    public function setStudent(array $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getClass(): array
    {
        return $this->class;
    }

    public function setClass(array $class): self
    {
        $this->class = $class;

        return $this;
    }
}
