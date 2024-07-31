<?php

namespace App\Entity;

use App\Repository\BarangMasukRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BarangMasukRepository::class)]
class BarangMasuk
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_masuk', type: 'integer')]
    private $id_masuk;

    #[ORM\ManyToOne(targetEntity: Barang::class, inversedBy: "barangMasuks")]
    #[ORM\JoinColumn(name: "id_barang", referencedColumnName:"id_barang")]
    private Barang $barang;

    #[ORM\Column(type: 'date', nullable: true)]
    private $tglMasuk;

    #[ORM\Column(type: 'text')]
    private $spesifikasi;

    #[ORM\Column(type: 'string', length: 255)]
    private $kondisi;

    #[ORM\Column(type: 'integer')]
    private $jmlMasuk;

    public function getId(): ?int
    {
        return $this->id_masuk;
    }

    public function getBarang(): ?Barang
    {
        return $this->barang;
    }

    public function setBarang(Barang $barang): self
    {
        $this->barang = $barang;

        return $this;
    }

    public function getTglMasuk(): ?\DateTimeInterface
    {
        return $this->tglMasuk;
    }

    public function setTglMasuk(?\DateTimeInterface $tglMasuk): self
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

    public function getKondisi(): ?string
    {
        return $this->kondisi;
    }

    public function setKondisi(string $kondisi): self
    {
        $this->kondisi = $kondisi;

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
