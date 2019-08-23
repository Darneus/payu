<?php declare(strict_types = 1);

namespace Darneus\PayU\DI;

class PayUConfig {

	/** @var bool */
	private $test;

	/** @var int|null */
	private $posId;

	/** @var int */
	private $clientId;

	/** @var string */
	private $secondKey;

	/** @var string */
	private $clientSecret;

	/** @var string */
	private $tempDir;

	/** @var string */
	private $grantType;

	/** @var string|null */
	private $email;

	/** @var string|null */
	private $extCustomerId;

	public function isTest() : bool {
		return $this->test;
	}

	public function setTest(bool $test) : void {
		$this->test = $test;
	}

	public function getPosId() : ?int {
		return $this->posId;
	}

	public function setPosId(?int $posId) : void {
		$this->posId = $posId;
	}

	public function getClientId() : int {
		return $this->clientId;
	}

	public function setClientId(int $clientId) : void {
		$this->clientId = $clientId;
	}

	public function getSecondKey() : string {
		return $this->secondKey;
	}

	public function setSecondKey(string $secondKey) : void {
		$this->secondKey = $secondKey;
	}

	public function getClientSecret() : string {
		return $this->clientSecret;
	}

	public function setClientSecret(string $clientSecret) : void {
		$this->clientSecret = $clientSecret;
	}

	public function getTempDir() : string {
		return $this->tempDir;
	}

	public function setTempDir(string $tempDir) : void {
		$this->tempDir = $tempDir;
	}

	public function getGrantType() : string {
		return $this->grantType;
	}

	public function setGrantType(string $grantType) : void {
		$this->grantType = $grantType;
	}

	public function getEmail() : ?string {
		return $this->email;
	}

	public function setEmail(?string $email) : void {
		$this->email = $email;
	}

	public function getExtCustomerId() : ?string {
		return $this->extCustomerId;
	}

	public function setExtCustomerId(?string $extCustomerId) : void {
		$this->extCustomerId = $extCustomerId;
	}

}