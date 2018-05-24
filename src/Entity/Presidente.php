<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PresidenteRepository")
 */
class Presidente
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nombre;

    /**
     * @ORM\Column(type="date")
     */
    private $fechanac;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Pais", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $paises;

    public function getId()
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFechanac(): ?\DateTimeInterface
    {
        return $this->fechanac;
    }

    public function setFechanac(\DateTimeInterface $fechanac): self
    {
        $this->fechanac = $fechanac;

        return $this;
    }

    public function getPaises(): ?Pais
    {
        return $this->paises;
    }

    public function setPaises(Pais $paises): self
    {
        $this->paises = $paises;

        return $this;
    }
}
