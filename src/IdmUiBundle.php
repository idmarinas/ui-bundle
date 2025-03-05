<?php
/**
 * Copyright 2024-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 05/03/2025, 22:37
 *
 * @project IDMarinas Ui Bundle
 * @see     https://github.com/idmarinas/ui-bundle
 *
 * @file    IdmUiBundle.php
 * @date    05/03/2025
 * @time    15:51
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Idm\Bundle\Ui;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class IdmUiBundle extends AbstractBundle
{
	public function loadExtension (array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
	{
		$container->import(dirname(__DIR__) . '/config/services.php');
	}

	public function prependExtension (ContainerConfigurator $container, ContainerBuilder $builder): void
	{
		$builder->prependExtensionConfig('twig_component', [
			'defaults' => [
				'Idm\\Bundle\\Ui\\Twig\\Component\\' => [
					'template_directory' => '@IdmUi/components',
					'name_prefix'        => 'IdmUi',
				],
			],
		]);
	}
}
