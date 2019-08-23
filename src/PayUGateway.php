<?php declare(strict_types = 1);

namespace Darneus\PayU;

use Darneus\PayU\DI\PayUConfig;
use Darneus\PayU\ValueObjects\Order;
use Darneus\PayU\ValueObjects\Payment\NewPaymentResponse;
use Darneus\PayU\ValueObjects\Payment\Status;
use OauthCacheFile;
use OauthGrantType;
use OpenPayU_Configuration;
use OpenPayU_Order;
use OpenPayU_Refund;
use OpenPayU_Result;

class PayUGateway {

	/**
	 * @var PayUConfig
	 */
	private $config;

	public function __construct(PayUConfig $payUConfig) {
		$this->config = $payUConfig;
		$this->initialize();
	}

	private function initialize() : void {
		//set Sandbox Environment
		if ($this->config->isTest()) {
			OpenPayU_Configuration::setEnvironment('sandbox');
		}

		OpenPayU_Configuration::setMerchantPosId($this->config->getPosId());
		OpenPayU_Configuration::setSignatureKey($this->config->getSecondKey());

		OpenPayU_Configuration::setOauthClientId($this->config->getClientId());
		OpenPayU_Configuration::setOauthClientSecret($this->config->getClientSecret());

		if ($this->config->getGrantType() === OauthGrantType::TRUSTED_MERCHANT) {
			OpenPayU_Configuration::setOauthEmail($this->config->getEmail());
			OpenPayU_Configuration::setOauthExtCustomerId($this->config->getExtCustomerId());
		}

		OpenPayU_Configuration::setOauthTokenCache(new OauthCacheFile($this->config->getTempDir()));
	}

	public function createPayment(Order $order) : NewPaymentResponse {
		if ($this->config->isTest()) {
			$order->setCurrencyCode('PLN');
		}
		return new NewPaymentResponse(OpenPayU_Order::create($order->toArray()));
	}

	public function getPaymentData(string $paymentId) : OpenPayU_Result {
		return OpenPayU_Order::retrieve($paymentId);
	}

	public function getTransactions(string $paymentId) : OpenPayU_Result {
		return OpenPayU_Order::retrieveTransaction($paymentId);
	}

	public function cancelPayment(string $paymentId) : OpenPayU_Result {
		return OpenPayU_Order::cancel($paymentId);
	}

	public function changePaymentStatus(string $paymentId, string $status = Status::COMPLETED) : OpenPayU_Result {
		return OpenPayU_Order::statusUpdate([
			"orderId" => $paymentId,
			"orderStatus" => $status
		]);
	}

	public function refundPayment(string $paymentId, string $description = 'Money refund', ?int $amount = NULL) : OpenPayU_Result {
		return OpenPayU_Refund::create($paymentId, $description, $amount);
	}

	public function processNotifyFromPayU() : ?OpenPayU_Result {
		$body = file_get_contents('php://input');
		$data = trim($body);

		if (empty($data)) {
			return NULL;
		}

		return OpenPayU_Order::consumeNotification($data);
	}

}