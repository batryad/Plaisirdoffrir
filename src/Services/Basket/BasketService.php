<?php

namespace App\Services\Basket;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BasketService {

    protected $session;
    protected $productRepository;


    public function __construct(SessionInterface $session, ProductRepository $productRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;

    }

    public function add(int $id) {

        $basket = $this->session->get('basket', []);
        if (!empty($basket[$id])) {
            $basket[$id] ++;

        }

        else {

            $basket[$id] =1;
        }

        $this->session->set('basket', $basket);



    }
    public function remove(int $id) {

        $basket = $this->session->get('basket', []);
        if (!empty($basket[$id])) {

            unset($basket[$id]);
        }

        $this->session->set('basket', $basket);



    }

   public function getFullBasket(): array {

       $basket = $this->session->get('basket', []);
       $basketData = [];

       foreach ($basket as $id => $quantity) {

           $basketData[] = [
               'product' => $this->productRepository->find($id),
               'quantity' => $quantity
           ];
       }
       return $basketData;
    }

    public function getTotal(): float {

        $total = 0;

        foreach ($this->getFullBasket() as $item) {

            $total += $item['product']->getPrice() * $item['quantity'];

        }
        return $total;
    }















}