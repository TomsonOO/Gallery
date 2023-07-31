<?php

namespace App\Controller;

use App\Entity\Image;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class ImageController extends AbstractController
{
    private $s3;

    public function __construct(S3Client $s3)
    {
        $this->s3 = $s3;
    }

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
        $image = new Image();

        /** @var UploadedFile $file */
        $file = $request->files->get('file');
        $filename = md5(uniqid()).'.'.$file->guessExtension();

        try {
            $result = $this->s3->putObject([
                'Bucket' => 'gallery-bazunia',
                'Key'    => $filename,
                'Body'   => fopen($file->getPathname(), 'rb'),
                'ACL'    => 'public-read',
            ]);

            $image->setUrl($result['ObjectURL']);
            $image->setName($filename);

            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

            return new Response('Image uploaded successfully', Response::HTTP_OK);
        } catch (S3Exception $e) {
            return new Response('There was an error uploading the file.', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
