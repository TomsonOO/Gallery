<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    public function getRoles(): array
    {
        // TODO: Return an array of roles for the user
    }

    public function eraseCredentials(): void
    {
        // TODO: Remove sensitive data from the user's credentials
    }

    public function getUserIdentifier(): string
    {
        // TODO: Return the identifier for the user (usually the username)
    }

    // TODO: Add email field

    // TODO: Add image relationship

    // TODO: Implement UserInterface methods

    // TODO: Add getters and setters
}
