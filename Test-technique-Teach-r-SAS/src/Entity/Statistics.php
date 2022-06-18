<?php

namespace App\Entity;

use App\Repository\StatisticsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatisticsRepository::class)]
class Statistics
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $count;

    #[ORM\Column(type: 'datetime')]
    private $date_count;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(?int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getDateCount(): ?\DateTimeInterface
    {
        return $this->date_count;
    }

    public function setDateCount(\DateTimeInterface $date_count): self
    {
        $this->date_count = $date_count;

        return $this;
    }
}
