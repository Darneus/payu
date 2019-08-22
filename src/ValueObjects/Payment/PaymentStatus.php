<?php declare(strict_types = 1);

namespace Darneus\PayU\ValueObjects\Payment;

class PaymentStatus {

	/** @var string */
	private $statusCode;

	/** @var string */
	private $statusDesc;

	public function __construct($response) {
		$this->statusCode = $response->statusCode;
		$this->statusDesc = $response->statusDesc ?? '';
	}

	public function getStatusCode() : string {
		return $this->statusCode;
	}

	public function getStatusDesc() : string {
		return $this->statusDesc;
	}
}