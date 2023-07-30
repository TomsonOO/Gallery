<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/users/{id}", methods={"GET"})
     */
    public function getUser(User $user): Response
    {
        // TODO: Return user as JSON
    }

    /**
     * @Route("/users", methods={"POST"})
     */
    public function createUser(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        // TODO: Create user from request data, encode password, and save to database
    }

    /**
     * @Route("/users/{id}", methods={"PUT"})
     */
    public function updateUser(User $user, Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        // TODO: Update user with request data, encode password, and save to database
    }
}
