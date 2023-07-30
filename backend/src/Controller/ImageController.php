<?php

namespace App\Controller;

use App\Entity\Image;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    /**
     * @Route("/images", methods={"GET"})
     */
    public function getImages(ImageRepository $imageRepository): Response
    {
        $images = $imageRepository->findAll();

        // TODO: Return images as JSON
    }

    /**
     * @Route("/images/{id}", methods={"GET"})
     */
    public function getImage(Image $image): Response
    {
        // TODO: Return image as JSON
    }

    /**
     * @Route("/images", methods={"POST"})
     */
    public function createImage(Request $request): Response
    {
        // TODO: Create image from request data and save to database
    }

    /**
     * @Route("/images/{id}", methods={"PUT"})
     */
    public function updateImage(Image $image, Request $request): Response
    {
        // TODO: Update image with request data and save to database
    }

    /**
     * @Route("/images/{id}", methods={"DELETE"})
     */
    public function deleteImage(Image $image): Response
    {
        // TODO: Delete image from database
    }
}
