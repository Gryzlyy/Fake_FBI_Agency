<?php

namespace App\Entity;

use App\Repository\AgentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AgentsRepository::class)
 */
class Agents
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min=2, max=20)
     * @ORM\Column(type="string", length=20)
     */
    private $lastName;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min=2, max=20)
     * @ORM\Column(type="string", length=20)
     */
    private $firstName;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min=2, max=30)
     * @ORM\Column(type="string", length=30)
     */
    private $codeName;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min=2, max=30)
     * @ORM\Column(type="string", length=50)
     */
    private $nationality;

    /**
     * @ORM\ManyToMany(targetEntity=Skills::class, mappedBy="agents")
     */
    private $skills;

    /**
     * @ORM\ManyToMany(targetEntity=Missions::class, mappedBy="agents")
     */
    private $missions;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getCodeName(): ?string
    {
        return $this->codeName;
    }

    public function setCodeName(string $codeName): self
    {
        $this->codeName = $codeName;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * @return Collection|Skills[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function displaySkills()
    {
        $agentsSkills = $this->skills;
        $skillsList = [];

        foreach ($agentsSkills as $skill) {
            $skillsList[] = $skill->getName();
        }
        return $skillsList;
    }

    public function addSkill(Skills $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->addAgent($this);
        }

        return $this;
    }

    public function removeSkill(Skills $skill): self
    {
        if ($this->skills->removeElement($skill)) {
            $skill->removeAgent($this);
        }

        return $this;
    }

    /**
     * @return Collection|Missions[]
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Missions $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->addAgent($this);
        }

        return $this;
    }

    public function removeMission(Missions $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            $mission->removeAgent($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->codeName;
    }
}
