<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints AS Assert;


/**
 * @UniqueEntity("Username")
 * @UniqueEntity("Email")
 * @UniqueEntity("Telephone")
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users implements UserInterface, Serializable
{
    const SEXE = [
        0 => 'Femme',
        1 => 'Homme'
    ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Length(min="3")
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @Assert\Length(min="3")
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Sexe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @Assert\Length(min="3")
     * @ORM\Column(type="string", length=255)
     */
    private $Username;

    /**
     * @Assert\Length(min="6", minMessage="Votre mot de passe doit etre au minimum 6 caracteres")
     * @ORM\Column(type="string", length=255)
     */
    private $Password;

    /**
     * @Assert\EqualTo(propertyPath="Password")
     * @var $confirm_password
     */
    public $confirm_password;
    /**
     * @var DateTime
     */
    private $CreatedAt;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $IpAdresse;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $IsActive;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $UpdatedAt;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ProfilFileName;

    /**
     * @var File|null
     */
    private $ImageProfile;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ConfirmToken;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $TokenResetPassword;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $CreateTokenPasswordAt;

    /**
     * Users constructor.
     */
    public function __construct()
    {
        $this->CreatedAt = new DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->Sexe;
    }

    public function getSexeType()
    {
        return self::SEXE[$this->Sexe];
    }

    public function setSexe(string $Sexe): self
    {
        $this->Sexe = $Sexe;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getConfirmPassword()
    {
        return $this->confirm_password;
    }

    /**
     * @param mixed $confirm_password
     */
    public function setConfirmPassword($confirm_password): void
    {
        $this->confirm_password = $confirm_password;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone): self
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getIpAdresse(): ?string
    {
        return $this->IpAdresse;
    }

    public function setIpAdresse(string $IpAdresse): self
    {
        $this->IpAdresse = $IpAdresse;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->IsActive;
    }

    public function setIsActive(bool $IsActive): self
    {
        $this->IsActive = $IsActive;

        return $this;
    }

    public function getCreateAt(): ?DateTimeInterface
    {
        return $this->CreateAt;
    }

    public function setCreateAt(DateTimeInterface $CreateAt): self
    {
        $this->CreateAt = $CreateAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function addRole($role): void
    {
        $this->roles[] = $role;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getProfilFileName(): ?string
    {
        return $this->ProfilFileName;
    }

    public function setProfilFileName(string $ProfilFileName): self
    {
        $this->ProfilFileName = $ProfilFileName;

        return $this;
    }

    public function getConfirmToken(): ?string
    {
        return $this->ConfirmToken;
    }

    public function setConfirmToken(string $ConfirmToken): self
    {
        $this->ConfirmToken = $ConfirmToken;

        return $this;
    }

    public function getTokenResetPassword(): ?string
    {
        return $this->TokenResetPassword;
    }

    public function setTokenResetPassword(string $TokenResetPassword): self
    {
        $this->TokenResetPassword = $TokenResetPassword;

        return $this;
    }

    public function getCreateTokenPasswordAt(): ?DateTimeInterface
    {
        return $this->CreateTokenPasswordAt;
    }

    public function setCreateTokenPasswordAt(DateTimeInterface $CreateTokenPasswordAt): self
    {
        $this->CreateTokenPasswordAt = $CreateTokenPasswordAt;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageProfile(): ?File
    {
        return $this->ImageProfile;
    }

    /**
     * @param File|null $ImageProfile
     */
    public function setImageProfile(?File $ImageProfile): void
    {
        $this->ImageProfile = $ImageProfile;
    }

    /**
     * Renvoie le sel utilisé à l'origine pour coder le mot de passe.
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Supprime les données sensibles de l'utilisateur.
     * Removes sensitive data from the user.
     *
     * Ceci est important si, à un moment donné, des informations sensibles
     * telles que le mot de passe en texte brut sont stockées sur cet objet.
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->Username,
            $this->Password
        ]);
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->Username,
            $this->Password
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }
}
