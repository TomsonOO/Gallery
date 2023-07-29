<?php

namespace App\Controller;

use App\Entity\Cat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CatController extends AbstractController
{
    /**
     * @Route("/cats", name="get_cats", methods={"GET"})
     */
    public function getCats(): Response
    {
        $cats = $this->getDoctrine()->getRepository(Cat::class)->findAll();

        // Return as JSON
        return $this->json($cats);
    }

    /**
     * @Route("/cats", name="add_cat", methods={"POST"})
     */
    public function addCat(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $cat = new Cat();
        $cat->setName($data['name']);
        $cat->setAge($data['age']);
        // Set additional properties as needed

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($cat);
        $entityManager->flush();

        return new Response('Cat added successfully', Response::HTTP_CREATED);
    }
}
