<?php

namespace App\Entity;

use App\Repository\MissionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MissionsRepository::class)
 */
class Missions
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
     * @Assert\Length(min=2, max=100)
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min=2, max=30)
     * @ORM\Column(type="string", length=30)
     */
    private $country;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min=2, max=30)
     * @ORM\Column(type="string", length=30)
     */
    private $type;

    /**
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min=2, max=30)
     * @ORM\Column(type="string", length=30)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $startDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $endDate;

    /**
     * @ORM\ManyToMany(targetEntity=Agents::class, inversedBy="missions")
     */
    private $agents;

    /**
     * @ORM\ManyToOne(targetEntity=Skills::class, inversedBy="missions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skills;

    /**
     * @ORM\ManyToMany(targetEntity=Targets::class, inversedBy="missions")
     */
    private $targets;

    /**
     * @ORM\ManyToMany(targetEntity=Contacts::class, mappedBy="missions")
     */
    private $contacts;

    /**
     * @ORM\ManyToOne(targetEntity=Hideouts::class, inversedBy="missions")
     */
    private $hideouts;

    public function __construct()
    {
        $this->agents = new ArrayCollection();
        $this->targets = new ArrayCollection();
        $this->contacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function setStartDate(string $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function setEndDate(string $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection|Agents[]
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(Agents $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents[] = $agent;
        }

        return $this;
    }

    public function removeAgent(Agents $agent): self
    {
        $this->agents->removeElement($agent);

        return $this;
    }

    public function getSkills(): ?Skills
    {
        return $this->skills;
    }

    public function setSkills(?Skills $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    /**
     * @return Collection|Targets[]
     */
    public function getTargets(): Collection
    {
        return $this->targets;
    }

    public function addTarget(Targets $target): self
    {
        if (!$this->targets->contains($target)) {
            $this->targets[] = $target;
        }

        return $this;
    }

    public function removeTarget(Targets $target): self
    {
        $this->targets->removeElement($target);

        return $this;
    }

    /**
     * @return Collection|Contacts[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contacts $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
        }

        return $this;
    }

    public function removeContact(Contacts $contact): self
    {
        $this->contacts->removeElement($contact);

        return $this;
    }

    public function getHideouts(): ?Hideouts
    {
        return $this->hideouts;
    }

    public function setHideouts(?Hideouts $hideouts): self
    {
        $this->hideouts = $hideouts;

        return $this;
    }

    // Missions' constraints
    public function areAgentNatAndTargetNatValid()
    {
        $agents = $this->agents;
        $targets = $this->targets;

        foreach ($agents as $agent)
        {
            foreach ($targets as $target)
            {
                if ($agent->getNationality() == $target->getNationality()) {
                    return false;
                }
            }
        }
        return true;
    }

    public function areContactNatAndMissionCountryValid()
    {
        $missionCountry = $this->country;
        $contacts = $this->contacts;

        foreach ($contacts as $contact)
        {
            if ($contact->getNationality() != $missionCountry) {
                return false;
            }
        }
        return true;
    }

    public function areHideoutCountryAndMissionCountryValid()
    {
        $hideouts = $this->hideouts;
        $missionCountry = $this->country;

        if ($hideouts) {
            if ($hideouts->getCountry() != $missionCountry) {
                return false;
            }
        }
        return true;
    }

    public function areMissionSkillAndAgentSkillValid()
    {
        $missionSkill = $this->skills;
        $agents = $this->agents;
        $skillsOk = 0;

        foreach($agents as $agent)
        {
            $agentSkills = $agent->displaySkills();
            if (in_array($missionSkill->getName(), $agentSkills)) {
                $skillsOk += 1;
            }
            if ($skillsOk == 0) {
                return false;
            }
        }
        return true;
    }

    public function isMissionValid()
    {
        if (!$this->areAgentNatAndTargetNatValid() || !$this->areContactNatAndMissionCountryValid() || !$this->areHideoutCountryAndMissionCountryValid() || !$this->areMissionSkillAndAgentSkillValid())
        {
            return false;
        }
        return true;
    }
}
