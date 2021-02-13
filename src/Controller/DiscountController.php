<?php

namespace App\Controller;

use App\Entity\User;
use App\Manager\DiscountManager;
use App\Service\Facade\DiscountProviderFacade;
use Exception;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiscountController extends AbstractController
{
    /**
     * @Route("/discount/register/{id}", name="register_discounts_for_user")
     * @param User                   $user
     * @param DiscountProviderFacade $discountProvider
     *
     * @return Response
     */
    public function registerDiscounts(User $user, DiscountProviderFacade $discountProvider): Response
    {
        try {
            $discountList = $discountProvider->registerDiscounts(10, $user);
            $serializer = SerializerBuilder::create()->build();
            $content = $serializer->toArray($discountList);
        } catch (Exception $exception) {
            return $this->json(
                [
                    'success' => false,
                    'error' => 'inter_server_error',
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return $this->json(
            [
                'success' => true,
                'data' => $content,
            ]
        );
    }

    /**
     * @Route("/discount/{id}", name="get_discounts_for_user")
     * @param User            $user
     * @param DiscountManager $discountManager
     *
     * @return Response
     */
    public function getDiscounts(User $user, DiscountManager $discountManager): Response
    {
        try {
            $discountList = $discountManager->getRegisteredDiscounts($user);
            $serializer = SerializerBuilder::create()->build();
            $content = $serializer->toArray($discountList);
        } catch (Exception $exception) {
            return $this->json(
                [
                    'success' => false,
                    'error' => 'inter_server_error',
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return $this->json(
            [
                'success' => true,
                'data' => $content,
            ]
        );
    }
}
