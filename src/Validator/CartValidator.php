<?php
namespace IPBuyOnRequest\Validator;

use Shopware\Core\Checkout\Cart\Cart;
use Shopware\Core\Checkout\Cart\CartValidatorInterface;
use Shopware\Core\Checkout\Cart\Error\ErrorCollection;
use Shopware\Core\Checkout\Cart\Error\IncompleteLineItemError;
use Shopware\Core\System\SalesChannel\SalesChannelContext;

class CartValidator implements CartValidatorInterface
{
    public function validate(Cart $cart, ErrorCollection $errors, SalesChannelContext $context): void
    {
        foreach ($cart->getLineItems()->getFlat() as $lineItem) {
            $customFields = $lineItem->getPayload()["customFields"];
            if (isset($customFields["IPBuyOnRequest_cf_buy_on_request"])) {
                $errors->add(new IncompleteLineItemError($lineItem->getId(), 'IPBuyOnRequest.cartError'));
                $cart->getLineItems()->removeElement($lineItem);
            }
        }
    }
}