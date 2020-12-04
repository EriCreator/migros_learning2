<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RandomNumberController extends AbstractController
{
    /**
     * @Route("/random/number", name="random_number")
     */
    public function index(): Response
    {
        $rand_number = -1;
        try {
            $rand_number = random_int(0, 100);
        } catch (\Exception $e) {
            // i dont care mate
        }

        return $this->render('random_number/index.html.twig', [
            'controller_name' => 'RandomNumberController',
            'some_random_int' => $rand_number,
        ]);
    }
}
