<?php declare(strict_types = 1);

namespace Darneus\PayU\ValueObjects\Payment;

class Status {
	public const NEW_PAYMENT = 'NEW';
	public const PENDING = 'PENDING';
	public const CANCELED = 'CANCELED';
	public const REJECTED = 'REJECTED';
	public const COMPLETED = 'COMPLETED';
	public const WAITING_FOR_CONFIRMATION = 'WAITING_FOR_CONFIRMATION';

	public const STATUSES = [
		self::NEW_PAYMENT => self::NEW_PAYMENT,
		self::PENDING => self::PENDING,
		self::CANCELED => self::CANCELED,
		self::REJECTED => self::REJECTED,
		self::COMPLETED => self::COMPLETED,
		self::WAITING_FOR_CONFIRMATION => self::WAITING_FOR_CONFIRMATION,
	];
}