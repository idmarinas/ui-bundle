<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 08/05/2025, 19:36
 *
 * @project IDMarinas Ui Bundle
 * @see https://github.com/idmarinas/ui-bundle
 *
 * @file Notification.php
 * @date 06/03/2025
 * @time 14:11
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
			->setNormalizer('closable', fn (Options $opts, bool $value) => ($opts['duration'] / 5000 >= 5))
			->setNormalizer(
				'type',
				fn(Options $opts, string|MessageVariantEnum $type) => MessageVariantEnum::normalizeValue($type)
			)
			->setNormalizer('title', fn(Options $opts, string|TranslatableInterface $value) => $this->translateOrSanitize($value))
			->setNormalizer('message', fn(Options $opts, string|TranslatableInterface $value) => $this->translateOrSanitize($value))
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
}
