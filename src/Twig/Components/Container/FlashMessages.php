<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 06/05/2025, 17:13
 *
 * @project IDMarinas Ui Bundle
 * @see https://github.com/idmarinas/ui-bundle
 *
 * @file FlashMessages.php
 * @date 06/03/2025
 * @time 19:18
 *
 * @author Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since 1.0.0
 */

namespace Idm\Bundle\Ui\Twig\Components\Container;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PreMount;

final class FlashMessages
{
	public array $messages;

	#[ExposeInTemplate('show_divider')]
	public bool $showDivider;

	#[PreMount]
	public function preMount (array $data): array
	{
		$resolver = new OptionsResolver();

		$resolver
			->setDefaults([
				'messages'    => [],
				'showDivider' => !empty($data['messages']),
			])
		;

		return $resolver->resolve($data);
	}
}
