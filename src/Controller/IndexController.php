<?php

namespace App\Controller;

use App\Entity\User;
use App\Manager\DiscountManager;
use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/frontend", name="login")
     * @param UserManager $userManager
     *
     * @return Response
     */
    public function loginPage(UserManager $userManager): Response
    {
        $userList = $userManager->getAllUsers();
        return $this->render(
            'index.html.twig',
            [
                'userList' => $userList,
            ]
        );
    }

    /**
     * @Route("/frontend/{id}", name="show_user_page")
     * @param User            $user
     * @param DiscountManager $discountManager
     *
     * @return Response
     */
    public function showUserPage(User $user, DiscountManager $discountManager): Response
    {
        $discountList = $discountManager->getRegisteredDiscounts($user);
        return $this->render(
            'userAction.html.twig',
            [
                'user' => $user,
                'discountList' => $discountList,
            ]
        );
    }
}
