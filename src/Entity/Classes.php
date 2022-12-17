<?php

namespace App\Entity;

use App\Repository\ClassesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassesRepository::class)]
class Classes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $students = [];

    #[ORM\Column(type: Types::ARRAY)]
    private array $school = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStudents(): array
    {
        return $this->students;
    }

    public function setStudents(array $students): self
    {
        $this->students = $students;

        return $this;
    }

    public function getSchool(): array
    {
        return $this->school;
    }

    public function setSchool(array $school): self
    {
        $this->school = $school;

        return $this;
    }
}
