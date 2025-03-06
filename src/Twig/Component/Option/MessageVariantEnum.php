<?php
/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 06/03/2025, 15:32
 *
 * @project IDMarinas Ui Bundle
 * @see     https://github.com/idmarinas/ui-bundle
 *
 * @file    MessageVariantEnum.php
 * @date    05/03/2025
 * @time    22:05
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Idm\Bundle\Ui\Twig\Component\Option;

enum MessageVariantEnum: string
{
	use IsValidValueEnumTrait;

	case Success = 'success';
	case Danger  = 'danger';
	case Error   = 'error';
	case Warning = 'warning';
	case Info    = 'info';
	case Notice  = 'notice';
}
