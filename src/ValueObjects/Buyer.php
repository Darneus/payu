<?php declare(strict_types = 1);

namespace Darneus\PayU\ValueObjects;

class Buyer {

	/** @var string */
	private $email;

	/** @var string */
	private $phone;

	/** @var string */
	private $firstName;

	/** @var string */
	private $lastName;

	public function __construct(string $email, string $phone, string $firstName, string $lastName) {
		$this->email = $email;
		$this->phone = $phone;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
	}

	public function toArray() : array {
		return [
			'email' => 		$this->email,
			'phone' => 		$this->phone,
			'firstName' => 	$this->firstName,
			'lastName' => 	$this->lastName
		];
	}
}