<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MundoRepository")
 */
class Mundo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $planeta;

    public function getId()
    {
        return $this->id;
    }

    public function getPlaneta(): ?string
    {
        return $this->planeta;
    }

    public function setPlaneta(?string $planeta): self
    {
        $this->planeta = $planeta;

        return $this;
    }
}
