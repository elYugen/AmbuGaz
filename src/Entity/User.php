<?php

namespace App\Entity;

use App\Repository\UserRepository;
use BcMath\Number;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $first_name = null;

    #[ORM\Column(length: 100)]
    private ?string $last_name = null;

    #[ORM\Column(length: 20)]
    private ?string $phone = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $company_id = null;

    /**
     * @var Collection<int, UserDocuments>
     */
    #[ORM\OneToMany(targetEntity: UserDocuments::class, mappedBy: 'user_id')]
    private Collection $userDocuments;

    /**
     * @var Collection<int, Disinfections>
     */
    #[ORM\OneToMany(targetEntity: Disinfections::class, mappedBy: 'user_id')]
    private Collection $disinfections;

    public function __construct()
    {
        $this->userDocuments = new ArrayCollection();
        $this->disinfections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Ensure the session doesn't contain actual password hashes by CRC32C-hashing them, as supported since Symfony 7.3.
     */
    public function __serialize(): array
    {
        $data = (array) $this;
        $data["\0".self::class."\0password"] = hash('crc32c', $this->password);

        return $data;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCompanyId(): ?Company
    {
        return $this->company_id;
    }

    public function setCompanyId(?Company $company_id): static
    {
        $this->company_id = $company_id;

        return $this;
    }

    /**
     * @return Collection<int, UserDocuments>
     */
    public function getUserDocuments(): Collection
    {
        return $this->userDocuments;
    }

    public function addUserDocument(UserDocuments $userDocument): static
    {
        if (!$this->userDocuments->contains($userDocument)) {
            $this->userDocuments->add($userDocument);
            $userDocument->setUserId($this);
        }

        return $this;
    }

    public function removeUserDocument(UserDocuments $userDocument): static
    {
        if ($this->userDocuments->removeElement($userDocument)) {
            // set the owning side to null (unless already changed)
            if ($userDocument->getUserId() === $this) {
                $userDocument->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Disinfections>
     */
    public function getDisinfections(): Collection
    {
        return $this->disinfections;
    }

    public function addDisinfection(Disinfections $disinfection): static
    {
        if (!$this->disinfections->contains($disinfection)) {
            $this->disinfections->add($disinfection);
            $disinfection->setUserId($this);
        }

        return $this;
    }

    public function removeDisinfection(Disinfections $disinfection): static
    {
        if ($this->disinfections->removeElement($disinfection)) {
            // set the owning side to null (unless already changed)
            if ($disinfection->getUserId() === $this) {
                $disinfection->setUserId(null);
            }
        }

        return $this;
    }
}
