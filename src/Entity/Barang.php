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
    private $barangMasuks;

    #[ORM\OneToMany(mappedBy: 'barang', targetEntity: BarangKeluar::class, orphanRemoval: true)]
    private $barangKeluars;

    public function __construct()
    {
        $this->barangMasuks = new ArrayCollection();
        $this->barangKeluars = new ArrayCollection();
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

    /**
     * @return Collection<int, BarangKeluar>
     */
    public function getBarangKeluars(): Collection
    {
        return $this->barangKeluars;
    }

    public function addBarangKeluar(BarangKeluar $barangKeluar): self
    {
        if (!$this->barangKeluars->contains($barangKeluar)) {
            $this->barangKeluars[] = $barangKeluar;
            $barangKeluar->setBarang($this);
        }

        return $this;
    }

    public function removeBarangKeluar(BarangKeluar $barangKeluar): self
    {
        if ($this->barangKeluars->removeElement($barangKeluar)) {
            // set the owning side to null (unless already changed)
            if ($barangKeluar->getBarang() === $this) {
                $barangKeluar->setBarang(null);
            }
        }

        return $this;
    }
}
