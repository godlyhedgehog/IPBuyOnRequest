<?php

namespace IPBuyOnRequest\Controller;

use Shopware\Core\Content\Product\ProductEntity;
use Shopware\Core\Framework\Api\Controller\ApiController;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @RouteScope(scopes={"api"})
 **/
class ProductStatusController extends ApiController
{

    /** @var EntityRepositoryInterface $productRepository */
    private $productRepository;

    public function __construct($productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @Route("/api/_action/ip_buy_on_request/{productId}", name="api.ip_buy_on_request.get_product_bor_status", methods={"GET"})
     */

    // Add for test usages >>>>>>>>  defaults={"auth_required"=false}
    public function getProductBORStatus(Request $request, Context $context, string $productId): Response
    {
        $result = false;
        $criteria = new Criteria([$productId]);
        /** @var ProductEntity $product */
        $product = $this->productRepository->search($criteria, $context)->first();
        if ($product) {
            if (isset($product->getCustomFields()["IPBuyOnRequest_cf_buy_on_request"])) {
                $result = $product->getCustomFields()["IPBuyOnRequest_cf_buy_on_request"];
            }
        }
        return new JsonResponse(['is_bor' => $result]);

    }
}