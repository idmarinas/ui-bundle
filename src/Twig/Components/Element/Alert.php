<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 06/05/2025, 14:02
 *
 * @project IDMarinas Ui Bundle
 * @see https://github.com/idmarinas/ui-bundle
 *
 * @file Alert.php
 * @date 05/03/2025
 * @time 18:13
 *
 * @author Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since 1.0.0
 */

namespace Idm\Bundle\Ui\Twig\Components\Element;

use Idm\Bundle\Ui\Traits\TranslateOrSanitizeTrait;
use Idm\Bundle\Ui\Twig\Components\Option\MessageVariantEnum;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatableInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
final class Alert
{
	use TranslateOrSanitizeTrait;

	public string             $title;
	public string             $message;
	public MessageVariantEnum $type;

	public function __construct (private readonly ?TranslatorInterface $translator = null) {}

	#[PreMount]
	public function preMount (array $data): array
	{
		$resolver = new OptionsResolver();

		$resolver
			->setIgnoreUndefined()
			->setDefaults([
				'title'   => '',
				'message' => '',
				'type'    => MessageVariantEnum::Notice,
			])
			->setRequired(['message'])
			->setAllowedTypes('title', ['string', TranslatableInterface::class])
			->setAllowedTypes('message', ['string', TranslatableInterface::class])
			->setAllowedTypes('type', ['string', MessageVariantEnum::class])
			->setAllowedValues('type', fn(string|MessageVariantEnum $value) => MessageVariantEnum::isValidValue($value))
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

	#[ExposeInTemplate('icon_class_cnt')]
	public function getIconClassCnt (): string
	{
		return match ($this->type) {
			MessageVariantEnum::Error,
			MessageVariantEnum::Danger  => 'bg-red-100 border-red-500',
			MessageVariantEnum::Success => 'bg-green-100 border-green-500',
			MessageVariantEnum::Warning => 'bg-yellow-100 border-yellow-500',
			MessageVariantEnum::Info    => 'bg-blue-100 border-blue-500',
			MessageVariantEnum::Notice  => 'bg-gray-100 border-gray-500',
		};
	}

	#[ExposeInTemplate('alert_class')]
	public function getAlertClass (): string
	{
		return match ($this->type) {
			MessageVariantEnum::Error,
			MessageVariantEnum::Danger  => 'bg-red-200 border-red-300 text-red-700',
			MessageVariantEnum::Success => 'bg-green-200 border-green-300 text-green-700',
			MessageVariantEnum::Warning => 'bg-yellow-200 border-yellow-300 text-yellow-700',
			MessageVariantEnum::Info    => 'bg-blue-200 border-blue-300 text-blue-700',
			MessageVariantEnum::Notice  => 'bg-gray-200 border-gray-300 text-gray-700',
		};
	}
}
