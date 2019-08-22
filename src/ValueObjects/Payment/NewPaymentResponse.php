<?php declare(strict_types = 1);

namespace Darneus\PayU\ValueObjects\Payment;

class NewPaymentResponse {

	/** @var PaymentStatus */
	private $status;

	/** @var string */
	private $redirectUri;

	/** @var string */
	private $orderId;

	public function __construct($response) {
		$this->status = new PaymentStatus($response->status);
		$this->redirectUri = $response->redirectUri;
		$this->orderId = $response->orderId;
	}

	public function getStatus() : PaymentStatus {
		return $this->status;
	}

	public function getRedirectUri() : string {
		return $this->redirectUri;
	}

	public function getOrderId() : string {
		return $this->orderId;
	}
}