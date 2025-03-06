<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 06/03/2025, 16:22
 *
 * @project IDMarinas Ui Bundle
 * @see     https://github.com/idmarinas/ui-bundle
 *
 * @file    IsValidValueEnumTrait.php
 * @date    06/03/2025
 * @time    15:25
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Idm\Bundle\Ui\Twig\Component\Option;

trait IsValidValueEnumTrait
{
	/**
	 *  Validates whether the value provided is an instance of the enum class or can be converted from a string.
	 */
	public static function isValidValue (string|self $value): bool
	{
		if ($value instanceof static) {
			return true;
		}

		return !(static::tryFrom($value) === null);
	}
}
