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

	public function toArray() : array {
		return [
			'name' 		=> $this->name,
			'unitPrice' => $this->unitPrice,
			'quantity' 	=> $this->quantity
		];
	}
}