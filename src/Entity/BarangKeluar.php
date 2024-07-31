<?php

namespace App\Entity;

use App\Repository\BarangKeluarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BarangKeluarRepository::class)]
class BarangKeluar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_keluar', type: 'integer')]
    private $idKeluar;

    #[ORM\Column(type: 'date', nullable: true)]
    private $tglKeluar;

    #[ORM\Column(type: 'integer')]
    private $jmlKeluar;

    #[ORM\Column(type: 'text')]
    private $deskripsi;

    #[ORM\ManyToOne(targetEntity: Barang::class, inversedBy: 'barangKeluars')]
    #[ORM\JoinColumn(name: "id_barang", referencedColumnName:"id_barang")]
    private Barang $barang;

    public function getId(): ?int
    {
        return $this->idKeluar;
    }

    public function getTglKeluar(): ?\DateTimeInterface
    {
        return $this->tglKeluar;
    }

    public function setTglKeluar(\DateTimeInterface $tglKeluar): self
    {
        $this->tglKeluar = $tglKeluar;

        return $this;
    }

    public function getJmlKeluar(): ?int
    {
        return $this->jmlKeluar;
    }

    public function setJmlKeluar(int $jmlKeluar): self
    {
        $this->jmlKeluar = $jmlKeluar;

        return $this;
    }

    public function getDeskripsi(): ?string
    {
        return $this->deskripsi;
    }

    public function setDeskripsi(string $deskripsi): self
    {
        $this->deskripsi = $deskripsi;

        return $this;
    }

    public function getBarang(): ?Barang
    {
        return $this->barang;
    }

    public function setBarang(?Barang $barang): self
    {
        $this->barang = $barang;

        return $this;
    }
}
