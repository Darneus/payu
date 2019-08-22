<?php declare(strict_types = 1);

namespace Darneus\PayU\DI;

use Darneus\PayU\Exceptions\InvalidConfigurationException;
use Nette\DI\CompilerExtension;
use OauthCacheFile;
use OauthGrantType;
use OpenPayU_Configuration;

class PayUExtension extends CompilerExtension {

	private $defaults = [
		'grantType' 	=> OauthGrantType::CLIENT_CREDENTIAL,
		'test' 			=> TRUE,
		'posId'			=> 0,
		'clientId' 		=> 0,
		'secondKey' 	=> '',
		'clientSecret' 	=> '',
		'email'			=> '',
		'extCustomerId' => '',
		'tempDir'		=> ''
	];

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults);

		if ($config['clientId'] === 0) {
			throw new InvalidConfigurationException('missing clientId');
		}

		if (empty($config['secondKey'])) {
			throw new InvalidConfigurationException('missing secondKey');
		}

		if (empty($config['clientSecret'])) {
			throw new InvalidConfigurationException('missing clientSecret');
		}

		if (empty($config['tempDir'])) {
			throw new InvalidConfigurationException('missing tempDir');
		}

		if (!in_array($config['grantType'], [OauthGrantType::TRUSTED_MERCHANT, OauthGrantType::CLIENT_CREDENTIAL])) {
			throw new InvalidConfigurationException('invalid grantType');
		}

		if ($config['grantType'] === OauthGrantType::TRUSTED_MERCHANT) {
			if (empty($config['email'])) {
				throw new InvalidConfigurationException('missing email');
			}

			if (empty($config['extCustomerId'])) {
				throw new InvalidConfigurationException('missing extCustomerId');
			}
		}

		$builder->addDefinition($this->prefix('config'))
			->setType(PayUConfig::class)
			->addSetup('setTest', [$config['test']])
			->addSetup('setPosId', [$config['posId']])
			->addSetup('setClientId', [$config['clientId']])
			->addSetup('setSecondKey', [$config['secondKey']])
			->addSetup('setClientSecret', [$config['clientSecret']])
			->addSetup('setTempDir', [$config['tempDir']])
			->addSetup('setGrantType', [$config['grantType']])
			->addSetup('setEmail', [$config['email']])
			->addSetup('setExtCustomerId', [$config['extCustomerId']]);
	}
}