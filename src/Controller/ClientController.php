<?php

namespace App\Controller;


use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
/**
 * @Route("/client")
 */
class ClientController extends AbstractController
{

    /** @var Serializer */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }
    public function listClients(ClientRepository $clientRepository): Response
    {
        $result =$clientRepository->findAll() ;
        $response = $this->serializer->normalize($result, null, ['groups' => ['client']]);    
        return new JsonResponse($response);

    }


   
}
