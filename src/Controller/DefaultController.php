<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\ClientController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/{reactRouting}", name="home", defaults={"reactRouting": null})
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/api/liens", name="list_liens")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getLiens()
    {
        return $this->forward('App\Controller\LienController::getLiens', array());
    }

    /**
     * @Route("/api/addPurchase", name="add_purchase")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function addPurchase()
    {
        return $this->forward('App\Controller\LienController::new', array());
    }
    /**
     * @Route("/api/clients/list", name="list_client")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function listClients()
    {
        return $this->forward('App\Controller\ClientController::listClients', array());
    }
    /**
     * @Route("/api/equipements/list", name="list_equipements")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function listEquipements()
    {
        return $this->forward('App\Controller\EquipementController::listEquipements', array());
    }
}
