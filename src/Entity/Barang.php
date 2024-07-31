<?php

namespace App\Entity;

use App\Repository\BarangRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: BarangRepository::class)]
class Barang
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_barang', type: 'integer')]
    private $id_barang;

    #[ORM\Column(type: 'string', length: 255)]
    private $namaBarang;

    #[ORM\OneToMany(targetEntity: BarangMasuk::class, mappedBy: "barang")]
    private Collection $barangMasuks;

    public function __construct()
    {
        $this->barangMasuks = new ArrayCollection();
    }

    public function getIdBarang(): ?int
    {
        return $this->id_barang;
    }

    public function setIdBarang(int $id_barang): self
    {
        $this->id_barang = $id_barang;

        return $this;
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
