<?php declare(strict_types = 1);

namespace Darneus\PayU\ValueObjects;

class Buyer {

	const DEFAULT_LANGUAGE = 'en';

	/** @var string */
	private $email;

	/** @var string */
	private $phone;

	/** @var string */
	private $firstName;

	/** @var string */
	private $lastName;

	/** @var string */
	private $language;

	public function __construct(string $email, string $phone, string $firstName, string $lastName) {
		$this->email = $email;
		$this->phone = $phone;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
	}

	public function getEmail() : string {
		return $this->email;
	}

	public function setEmail(string $email) : void {
		$this->email = $email;
	}

	public function getPhone() : string {
		return $this->phone;
	}

	public function setPhone(string $phone) : void {
		$this->phone = $phone;
	}

	public function getFirstName() : string {
		return $this->firstName;
	}

	public function setFirstName(string $firstName) : void {
		$this->firstName = $firstName;
	}

	public function getLastName() : string {
		return $this->lastName;
	}

	public function setLastName(string $lastName) : void {
		$this->lastName = $lastName;
	}

	public function getLanguage(): string {
		return $this->language;
	}

	public function setLanguage(string $language): void	{
		$this->language = $language;
	}

	public function toArray() : array {
		return [
			'email' => 		$this->email,
			'phone' => 		$this->phone,
			'firstName' => 	$this->firstName,
			'lastName' => 	$this->lastName,
			'language' =>   $this->language ?? static::DEFAULT_LANGUAGE
		];
	}
}