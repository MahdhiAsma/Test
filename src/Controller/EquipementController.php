<?php

namespace App\Controller;


use App\Repository\EquipementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/equipement")
 */
class EquipementController extends AbstractController
{
       /** @var Serializer */
       private $serializer;

       public function __construct(SerializerInterface $serializer)
       {
           $this->serializer = $serializer;
       }
       public function listEquipements(EquipementRepository $equipementRepository): Response
       {
           $result =$equipementRepository->findAll() ;
           $response = $this->serializer->normalize($result, null, ['groups' => ['equipement']]);    
           return new JsonResponse($response);
   
       }
     
}
