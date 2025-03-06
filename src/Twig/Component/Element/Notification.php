<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 06/03/2025, 21:23
 *
 * @project IDMarinas Ui Bundle
 * @see     https://github.com/idmarinas/ui-bundle
 *
 * @file    Notification.php
 * @date    06/03/2025
 * @time    14:11
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Idm\Bundle\Ui\Twig\Component\Element;

use Idm\Bundle\Ui\Traits\TranslateOrSanitizeTrait;
use Idm\Bundle\Ui\Twig\Component\Option\MessageVariantEnum;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DivisibleBy;
use Symfony\Component\Validator\Validation;
use Symfony\Contracts\Translation\TranslatableInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
final class Notification
{
	use TranslateOrSanitizeTrait;

	public string             $title;
	public string             $message;
	public MessageVariantEnum $type;
	public bool               $closable;
	public int                $duration;

	public function __construct (private readonly ?TranslatorInterface $translator = null) {}

	#[PreMount]
	public function preMount (array $data): array
	{
		$resolver = new OptionsResolver();

		$resolver
			->setIgnoreUndefined()
			->setDefaults([
				'title'    => '',
				'message'  => '',
				'type'     => MessageVariantEnum::Notice,
				'closable' => true,
				'duration' => 5000,
				'id'       => null,
			])
			->setRequired('message')
			->setAllowedTypes('title', ['string', TranslatableInterface::class])
			->setAllowedTypes('message', ['string', TranslatableInterface::class])
			->setAllowedTypes('type', ['string', MessageVariantEnum::class])
			->setAllowedTypes('closable', 'bool')
			->setAllowedTypes('duration', 'int')
			->setAllowedTypes('id', ['int', 'string', 'null'])
			->setAllowedValues('type', fn(string|MessageVariantEnum $value) => MessageVariantEnum::isValidValue($value))
			->setAllowedValues('duration', Validation::createIsValidCallable(new DivisibleBy(5000)))
			->setNormalizer('closable', function (Options $opts, int $value) {
				// Force to be closable if duration is 5 times the default duration
				if ($opts['duration'] / 5000 >= 5) {
					$value = true;
				}

				return $value;
			})
			->setNormalizer(
				'type',
				fn(Options $opts, string|MessageVariantEnum $type) => MessageVariantEnum::normalizeValue($type)
			)
			->setNormalizer(
				'title',
				fn(Options $opts, string|TranslatableInterface $value) => $this->translateOrSanitize($value)
			)
			->setNormalizer(
				'message',
				fn(Options $opts, string|TranslatableInterface $value) => $this->translateOrSanitize($value)
			)
		;

		return $resolver->resolve($data) + $data;
	}

	#[ExposeInTemplate('notification_class')]
	public function getNotificationClass (): string
	{
		return match ($this->type) {
			MessageVariantEnum::Error,
			MessageVariantEnum::Danger  => 'bg-red-400 border-red-700 text-red-50',
			MessageVariantEnum::Success => 'bg-green-400 border-green-700 text-green-50',
			MessageVariantEnum::Warning => 'bg-yellow-400 border-yellow-700 text-yellow-50',
			MessageVariantEnum::Info    => 'bg-blue-400 border-blue-700 text-blue-50',
			MessageVariantEnum::Notice  => 'bg-gray-400 border-gray-700 text-gray-50',
		};
	}

	#[ExposeInTemplate('icon_class_cnt')]
	public function getIconClassCnt (): string
	{
		return match ($this->type) {
			MessageVariantEnum::Error,
			MessageVariantEnum::Danger  => 'bg-red-100 border-red-500 text-red-400',
			MessageVariantEnum::Success => 'bg-green-100 border-green-500 text-green-400',
			MessageVariantEnum::Warning => 'bg-yellow-100 border-yellow-500 text-yellow-400',
			MessageVariantEnum::Info    => 'bg-blue-100 border-blue-500 text-blue-400',
			MessageVariantEnum::Notice  => 'bg-gray-100 border-gray-500 text-gray-400',
		};
	}

	#[ExposeInTemplate('icon_name')]
	public function getIconName (): string
	{
		return match ($this->type) {
			MessageVariantEnum::Error,
			MessageVariantEnum::Danger  => 'tabler:x',
			MessageVariantEnum::Success => 'tabler:check',
			MessageVariantEnum::Warning => 'tabler:exclamation-mark',
			MessageVariantEnum::Info    => 'tabler:info-circle',
			MessageVariantEnum::Notice  => 'tabler:message',
		};
	}
}
