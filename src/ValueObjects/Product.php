<?php declare(strict_types = 1);

namespace Darneus\PayU\ValueObjects;

class Product {

	/** @var string */
	private $name;

	/** @var int */
	private $unitPrice;

	/** @var int */
	private $quantity;

	public function __construct(string $name, int $unitPrice, int $quantity = 1) {
		$this->name = $name;
		$this->unitPrice = $unitPrice;
		$this->quantity = $quantity;
	}

	public function getName() : string {
		return $this->name;
	}

	public function setName(string $name) : void {
		$this->name = $name;
	}

	public function getUnitPrice() : int {
		return $this->unitPrice;
	}

	public function setUnitPrice(int $unitPrice) : void {
		$this->unitPrice = $unitPrice;
	}

	public function getQuantity() : int {
		return $this->quantity;
	}

	public function setQuantity(int $quantity) : void {
		$this->quantity = $quantity;
	}

	public function toArray() : array {
		return [
			'name' 		=> $this->name,
			'unitPrice' => $this->unitPrice,
			'quantity' 	=> $this->quantity
		];
	}
}