<?php

namespace App\Controller;

use App\Entity\Image;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Symfony\Component\Dotenv\Dotenv;

class ImageController extends AbstractController
{
    private $s3;
    private $em;


    public function __construct(S3Client $s3, EntityManagerInterface $em)
    {
        $this->s3 = $s3;
        $this->em = $em;
    }

    public function fetchImages(ImageRepository $imageRepository)
    {
        $images = $imageRepository->findAll();

        // Transform the array of images into an array of image arrays
        $imageData = array_map(function (Image $image) {
            return [
                'id' => $image->getId(),
                'url' => $image->getUrl(),
                'title' => $image->getTitle(),
                'description' => $image->getDescription(),
                'filename' => $image->getFilename(),
            ];
        }, $images);

        return $imageData;
    }

    /**
     * @Route("/images", methods={"GET"})
     */
    public function getImages(ImageRepository $imageRepository): Response
    {
        $imageData = $this->fetchImages($imageRepository);

        // Return the data as a JSON response
        return new Response(json_encode($imageData), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/signed-url/{key}", name="signed_url")
     */
    public function signedUrl(string $key, ImageRepository $imageRepository)
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'/../../.env');

        $awsAccessKeyId = $_ENV['AWS_ACCESS_KEY_ID'];
        $awsSecretAccessKey = $_ENV['AWS_SECRET_ACCESS_KEY'];

        $imageData = $this->fetchImages($imageRepository);

//        dump($awsAccessKeyId, $awsSecretAccessKey);
//        dd($awsAccessKeyId);
//        var_dump($key);

        $s3Client = new S3Client([
            'version' => 'latest',
            'region'  => 'eu-west-1', // Replace with your S3 region
            'credentials' => [
                'key'    => $awsAccessKeyId,
                'secret' => $awsSecretAccessKey,
            ],
        ]);
        $firstImageTitle = '';
        foreach ($imageData as $image) {
            if ($image['id'] == $key) {
                $firstImageTitle = $image['title'];
                break;
            }
        }


        $cmd = $s3Client->getCommand('GetObject', [
            'Bucket' => 'gallery-bazunia', // Replace with your bucket name
            'Key'    => $firstImageTitle

        ]);

        $request = $s3Client->createPresignedRequest($cmd, '+20 minutes');

        $presignedUrl = (string) $request->getUri();

        return $this->json(['url' => $presignedUrl]);
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

        if (!$file) {
            return new Response('No file was uploaded.', Response::HTTP_BAD_REQUEST);
        }

        $originalFilename = $file->getClientOriginalName();
        $newFilename = md5(uniqid()) . '.' . $file->guessExtension();

        try {
            $this->s3->putObject([
                'Bucket' => 'gallery-bazunia',
                'Key'    => $newFilename,
                'Body'   => fopen($file->getPathname(), 'rb'),
            ]);

            $image->setUrl('https://gallery-bazunia.s3.eu-west-1.amazonaws.com/' . $newFilename);
            $image->setTitle($newFilename);
            $image->setDescription('');
            $image->setFilename($originalFilename); // Set the original filename

            $this->em->persist($image);
            $this->em->flush();

            return new Response('Image uploaded successfully', Response::HTTP_OK);
        } catch (S3Exception $e) {
            return new Response('There was an error uploading the file to S3: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
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
