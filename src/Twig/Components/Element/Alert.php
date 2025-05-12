<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 11/05/2025, 21:49
 *
 * @project IDMarinas Ui Bundle
 * @see     https://github.com/idmarinas/ui-bundle
 *
 * @file    Alert.php
 * @date    05/03/2025
 * @time    18:13
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Idm\Bundle\Ui\Twig\Components\Element;

use Idm\Bundle\Ui\Traits\TranslateOrSanitizeTrait;
use Idm\Bundle\Ui\Twig\Components\Option\MessageVariantEnum;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatableInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
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
			->setNormalizer('type', fn(Options $opts, string|MessageVariantEnum $v) => MessageVariantEnum::normalizeValue($v))
			->setNormalizer('title', fn(Options $opts, string|TranslatableInterface $v) => $this->translateOrSanitize($v))
			->setNormalizer('message', fn(Options $opts, string|TranslatableInterface $v) => $this->translateOrSanitize($v))
		;

		return $resolver->resolve($data) + $data;
	}
}
