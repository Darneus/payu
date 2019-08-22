<?php declare(strict_types = 1);

namespace Darneus\PayU\ValueObjects;

use OpenPayU_Configuration;

class Order {

	/** @var string */
	private $id;

	/** @var string */
	private $continueUrl;

	/** @var string */
	private $notifyUrl;

	/** @var string */
	private $customerIp;

	/** @var int */
	private $merchantPosId;

	/** @var string */
	private $description;

	/** @var string */
	private $currencyCode;

	/** @var int */
	private $totalAmount;

	/** @var Product[] */
	private $products = [];

	/** @var Buyer */
	private $buyer;

	public function __construct(int $id, string $description, string $currencyCode, int $totalAmount) {
		$this->id = $id;
		$this->description = $description;
		$this->currencyCode = $currencyCode;
		$this->totalAmount = $totalAmount;

		$this->customerIp = $_SERVER['REMOTE_ADDR'];
	}

	public function setContinueUrl(string $continueUrl) : void {
		$this->continueUrl = $continueUrl;
	}

	public function setNotifyUrl(string $notifyUrl) : void {
		$this->notifyUrl = $notifyUrl;
	}

	public function setMerchantPosId(int $merchantPosId) : void {
		$this->merchantPosId = $merchantPosId;
	}

	public function toArray() : array {
		$order = [
			'continueUrl' 	=> $this->continueUrl,
			'customerIp' 	=> $this->customerIp,
			'merchantPosId' => $this->merchantPosId ?? OpenPayU_Configuration::getMerchantPosId(),
			'description' 	=> $this->description,
			'currencyCode' 	=> $this->currencyCode,
			'totalAmount' 	=> $this->totalAmount,
			'extOrderId' 	=> $this->id,
		];

		if ($this->notifyUrl !== NULL) {
			$order['notifyUrl'] = $this->notifyUrl;
		}

		foreach ($this->products as $product) {
			$order['products'][] = $product->toArray();
		}

		$order['buyer'] = $this->buyer->toArray();

		return $order;
	}

}