<?php

namespace App\Entity;

use App\Repository\BarangMasukRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BarangMasukRepository::class)]
class BarangMasuk
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $barang;

    #[ORM\Column(type: 'date')]
    private $tglMasuk;

    #[ORM\Column(type: 'text')]
    private $spesifikasi;

    #[ORM\Column(type: 'integer')]
    private $jmlMasuk;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBarang(): ?string
    {
        return $this->barang;
    }

    public function setBarang(string $barang): self
    {
        $this->barang = $barang;

        return $this;
    }

    public function getTglMasuk(): ?\DateTimeInterface
    {
        return $this->tglMasuk;
    }

    public function setTglMasuk(\DateTimeInterface $tglMasuk): self
    {
        $this->tglMasuk = $tglMasuk;

        return $this;
    }

    public function getSpesifikasi(): ?string
    {
        return $this->spesifikasi;
    }

    public function setSpesifikasi(string $spesifikasi): self
    {
        $this->spesifikasi = $spesifikasi;

        return $this;
    }

    public function getJmlMasuk(): ?int
    {
        return $this->jmlMasuk;
    }

    public function setJmlMasuk(int $jmlMasuk): self
    {
        $this->jmlMasuk = $jmlMasuk;

        return $this;
    }
}
