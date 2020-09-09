<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Services\Basket\BasketService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    /**
     * @Route("/panier", name="basket_index")
     * @param BasketService $basketService
     * @return Response
     */
    public function index(BasketService $basketService)
    {

        return $this->render('basket/index.html.twig', [
            'items' => $basketService->getFullBasket(),
            'total' => $basketService->getTotal()
        ]);
    }

    /**
     * @Route("/panier/ajout/{id}", name="basket_add")
     * @param $id
     * @param BasketService $basketService
     * @return RedirectResponse
     */
    public function add($id, BasketService $basketService) {

        $basketService->add($id);

        return $this->redirectToRoute('basket_index');
    }

    /**
     * @Route("panier/supprimer/{id}", name="basket_remove")
     * @param $id
     * @param BasketService $basketService
     * @return RedirectResponse
     */

    public function remove($id, BasketService $basketService) {

        $basketService->remove($id);


        return $this->redirectToRoute("basket_index");

    }
}
