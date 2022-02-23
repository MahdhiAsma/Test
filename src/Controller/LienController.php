<?php

namespace App\Controller;

use App\Entity\Lien;
use App\Entity\Equipement;

use App\Entity\Client;

use App\Form\LienType;
use App\Repository\LienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/lien")
 */
class LienController extends AbstractController
{

  /** @var Serializer */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route("/new", name="lien_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager)
    {
        $data= json_decode($request->getContent(), true)["data"];

        $lien = new Lien();
        $equipement = $entityManager->getRepository(Equipement::class)->findOneBy(['id' =>$data["equipement"]]);
        $client = $entityManager->getRepository(Client::class)->findOneBy(['id' =>$data["client"]]);
        
        $lien->addEquipement($equipement);
        $lien->setClient($client);
        $lien->setQuantity($data["client"]);

        $form = $this->createForm(LienType::class, $lien);
      
        $entityManager->persist($lien);
        $entityManager->flush();
        return $this->forward('App\Controller\LienController::getLiens', array());
    }

  

    /**
     * @Route("/", name="lien_index", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getLiens(LienRepository $lienRepository): JsonResponse
    {
        $response = [];

        $liens =$lienRepository->findall() ;
        $clients =[];
        $liens = $this->serializer->normalize($liens, null, ['groups' => ['lien']]);

        foreach ($liens as $value) {
            $clients[$value['client']['id']][] = $value;
        }

        foreach ($clients as $client) {
            $first = 0;
            if (count($client)> 1) {
                $totalPrice = 0 ;
                
                foreach ($client as $row) {
                    $totalPrice = $totalPrice + ($row["Equipement"][0]["price"] * $row["quantity"]);
                }
                if ($totalPrice > 30000) {
                    $response[] = [
                     "id" => $row['id'],
                     "name" => $row["client"]['name'],
                     "address" => $row["client"]['address'],
                     "totalPrice" => $totalPrice
                    ];
                    if ($totalPrice > $first) {
                        $first = $totalPrice ;
                    }
                };
            }
        }
        usort($response, function ($first, $second) {
            if ($first['totalPrice'] == $second['totalPrice']) {
                return 0 ;
            }

            return ($first['totalPrice'] >  $second['totalPrice'])? 1 : -1;
            ;
        });
        $totalPriceSort  = array_column($response, 'totalPrice');

        array_multisort($totalPriceSort, SORT_DESC, $response);

        return new JsonResponse($response);
    }
}
