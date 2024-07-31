<?php

namespace App\Entity;

use App\Repository\BarangRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BarangRepository::class)]
class Barang
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $idBarang;

    #[ORM\Column(type: 'string', length: 255)]
    private $namaBarang;

    public function getId(): ?int
    {
        return $this->idBarang;
    }

    public function getNamaBarang(): ?string
    {
        return $this->namaBarang;
    }

    public function setNamaBarang(string $namaBarang): self
    {
        $this->namaBarang = $namaBarang;

        return $this;
    }
}
