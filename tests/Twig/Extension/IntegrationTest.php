<?php
/**
 * Copyright 2021-2026 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 08/01/2026, 13:19
 *
 * @project IDMarinas Ui Bundle
 * @see     https://github.com/idmarinas/ui-bundle
 *
 * @file    IntegrationTest.php
 * @date    05/03/2025
 * @time    15:51
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Idm\Bundle\Template\Tests\Twig\Extension;

use App\Kernel;
use PHPUnit\Framework\Attributes\Group;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Test\IntegrationTestCase;

/**
 * Test Twig Extensions.
 */
#[Group("ignore")]
final class IntegrationTest extends IntegrationTestCase
{
	public static function getFixturesDirectory (): string
	{
		return __DIR__ . '/Fixtures/';
	}

	public function getExtensions (): array
	{
		return [];
	}

	protected function getContainer (): ContainerInterface
	{
		$kernel = new Kernel('test', true);
		$kernel->addExtraConfig(dirname(__DIR__, 2) . '/config/idm_advertising.php');
		$kernel->boot();

		return $kernel->getContainer();
	}
}
