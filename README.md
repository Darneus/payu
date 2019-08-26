# PayU for Nette

- install by composer
```
composer require darneus/payu
```

- register extension: config.neon
```neon
extensions:
        payUExtension: Darneus\PayU\DI\PayUExtension

payUExtension:
        test: true
        clientId: 300746
        secondKey: 'b6ca15b0d1020e8094d9b5f8d163db54'
        clientSecret: '2ee86a66e5d97e3fadc400c9f19b065d'
        tempDir: %appDir%/../temp
```

- use PayUGateway.php
```php
    /**
     * @var \Darneus\PayU\PayUGateway
     */
    private $payUGateway;

    private $order;
    
    public function __construct(PayUGateway $payUGateway) {
        $this->payUGateway = $payUGateway;
    }

    public function hanlePay() : ?string {
        $payUOrder = new Order('1234', 'Order 1234', 'PLN', 10000);
        $payUOrder->setContinueUrl($this->link('//return!'));
        $payUOrder->setBuyer(new Buyer(cust@mail.com, 123456789, 'John', 'Doe'));

        $payUOrder->addProduct(new Product('product', 10000, 1);
		
        $response = $this->payUGateway->createPayment($payUOrder);

        $order->setPaymentId($response->getOrderId());

        $this->redirectUrl($response->getRedirectUri());
    }

    public function handleReturn() : void {
        $result = $this->getPaymentData($order->getPaymentId());

        $status = reset($result->getResponse()->orders)->status;
        if ($status === 'COMPLETED') {
            $order->setPaid();
        }
    }
```