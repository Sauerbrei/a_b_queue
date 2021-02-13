<?php

namespace App\Controller;

use App\Entity\Discount;
use App\Entity\User;
use App\Exception\Model\DiscountAlreadyUsedException;
use App\Exception\Model\DiscountExpiredException;
use App\Manager\DiscountManager;
use App\Service\Facade\DiscountProviderFacade;
use Doctrine\ORM\EntityNotFoundException;
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

    /**
     * @Route("/discount/claim/{id}", name="claim_discount")
     * @param Discount               $discount
     * @param DiscountProviderFacade $discountProvider
     *
     * @return Response
     */
    public function claimDiscount(Discount $discount, DiscountProviderFacade $discountProvider): Response
    {
        try {
            $discountProvider->claimDiscount($discount);
        } catch (EntityNotFoundException $exception) {
            return $this->json(
                [
                    'success' => false,
                    'error' => $exception->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        } catch (DiscountAlreadyUsedException|DiscountExpiredException $exception) {
            return $this->json(
                [
                    'success' => false,
                    'error' => $exception->getMessage(),
                ],
                Response::HTTP_CONFLICT
            );
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
            ]
        );
    }
}
