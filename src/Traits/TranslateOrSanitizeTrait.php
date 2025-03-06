<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 07/03/2025, 24:01
 *
 * @project IDMarinas Ui Bundle
 * @see     https://github.com/idmarinas/ui-bundle
 *
 * @file    TranslateOrSanitizeTrait.php
 * @date    06/03/2025
 * @time    15:49
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Idm\Bundle\Ui\Traits;

use Symfony\Contracts\Translation\TranslatableInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

trait TranslateOrSanitizeTrait
{
	/**
	 * Translates the message if it is a translatable object or sanitize the HTML if it is a string.
	 */
	public function translateOrSanitize (string|TranslatableInterface $message): string
	{
		if (is_string($message)) {
			return $this->sanitizeHtml($message);
		}

		return $this->translate($message);
	}

	/**
	 * TODO: completed this method
	 */
	public function sanitizeHtml (string $message): string
	{
		return $message;
	}

	public function translate (TranslatableInterface $message): string
	{
		if ($this->translator instanceof TranslatorInterface) {
			return $message->trans($this->translator);
		}

		return (string)$message;
	}
}
