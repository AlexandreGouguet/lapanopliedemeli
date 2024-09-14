<?php

namespace App\Service;

use App\Entity\Cart;

class PaypalPaymentService
{
    private string $paypalClientId;

    public function __construct(string $paypalClientId)
    {
        $this->paypalClientId = $paypalClientId;
    }

    public function ui(?Cart $cart): string
    {
        if($cart === null){
            return '';
        }

        $order = json_encode([
            'orderId' => $cart->getId(),
            'purchase_units' => [[
                'description' => 'Order #' . $cart->getId(),
                'items' => array_map(function ($cartProduct) {
                    return [
                        'name' => $cartProduct->getProduct()->getName(),
                        'quantity' => $cartProduct->getQuantity(),
                        'unit_amount' => [
                            'value' => $cartProduct->getProduct()->getPrice(),
                            'currency_code' => 'EUR'
                        ]
                    ];
                }, $cart->getCartProducts()->toArray()),
                'amount' => [
                    'currency_code' => 'EUR',
                    'value' => $cart->getTotal(),
                    'breakdown' => [
                        'item_total' => [
                            'currency_code' => 'EUR',
                            'value' => $cart->getTotal()
                        ]
                    ]
                ]
            ]]
        ]);

        return <<<HTML
            <script src="https://www.paypal.com/sdk/js?client-id={$this->paypalClientId}&currency=EUR&intent=authorize"></script>
            <div id="paypal-button-container"></div>
            <script>
              paypal.Buttons({
                // Sets up the transaction when a payment button is clicked
                createOrder: (data, actions) => {
                  return actions.order.create({$order})
                },
                // Finalize the transaction after payer approval
                onApprove: async (data, actions) => {
                  await actions.order.authorize();
                  redirectToSuccess();
                }
              }).render('#paypal-button-container');
            </script>
        HTML;
    }
}