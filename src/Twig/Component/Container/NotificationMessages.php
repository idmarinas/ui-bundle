<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 06/03/2025, 21:13
 *
 * @project IDMarinas Ui Bundle
 * @see     https://github.com/idmarinas/ui-bundle
 *
 * @file    NotificationMessages.php
 * @date    06/03/2025
 * @time    19:20
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Idm\Bundle\Ui\Twig\Component\Container;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\PreMount;

final class NotificationMessages
{
	public array $messages;

	#[PreMount]
	public function preMount (array $data): array
	{
		$resolver = new OptionsResolver();

		$resolver
			->setDefaults([
				'messages' => [],
			])
		;

		return $resolver->resolve($data);
	}
}
