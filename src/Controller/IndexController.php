<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/frontend/{id}", name="index")
     * @param User $user
     *
     * @return Response
     */
    public function showUserPage(User $user): Response
    {

        return $this->render(
            'index.html.twig',
            [
                'user' => $user,
            ]
        );
    }
}
