<?php

namespace App\Controller\Api;

use App\Repository\ShowRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiAdminController extends AbstractController
{

    /**
     * @Route("/api/showsList", name="api_show_list_get", methods={"GET"})
     */
    public function showList(EntityManagerInterface $em, ShowRepository $showRepository, SerializerInterface $serializer)
    {

        $shows = $showRepository->findAll();
        
        return new JsonResponse(
            $serializer->serialize($shows, 'json'),
            JsonResponse::HTTP_OK,
            [],
            true
        );

    }
}