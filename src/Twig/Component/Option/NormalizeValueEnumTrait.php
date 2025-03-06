<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 06/03/2025, 23:55
 *
 * @project IDMarinas Ui Bundle
 * @see     https://github.com/idmarinas/ui-bundle
 *
 * @file    NormalizeValueEnumTrait.php
 * @date    06/03/2025
 * @time    15:34
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Idm\Bundle\Ui\Twig\Component\Option;

trait NormalizeValueEnumTrait
{
	public static function normalizeValue (string|self $value): self
	{
		if ($value instanceof static) {
			return $value;
		}

		$value = static::tryFrom($value);

		return empty($value) ? static::Default : $value;
	}
}
