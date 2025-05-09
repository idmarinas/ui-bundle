<?php
/**
 * Copyright 2024-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 09/05/2025, 18:22
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

use Symfony\Component\AssetMapper\AssetMapperInterface;
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
				'Idm\\Bundle\\Ui\\Twig\\Components\\' => [
					'template_directory' => '@IdmUi/components',
					'name_prefix'        => 'IdmUi',
				],
			],
		]);

		if ($this->isAssetMapperAvailable($builder)) {
			$builder->prependExtensionConfig('framework', [
				'asset_mapper' => [
					'paths' => [
						dirname(__DIR__) . '/assets/dist' => '@idmarinas/ui-bundle',
					],
				],
			]);
		}

		$builder->prependExtensionConfig('ux_icons', [
			'aliases' => [
				'alert:error'   => 'tabler:x',
				'alert:danger'  => 'tabler:x',
				'alert:success' => 'tabler:check',
				'alert:warning' => 'tabler:exclamation-mark',
				'alert:info'    => 'tabler:info-circle',
				'alert:notice'  => 'tabler:message',
			],
		]);
	}

	private function isAssetMapperAvailable (ContainerBuilder $container): bool
	{
		if (!interface_exists(AssetMapperInterface::class)) {
			return false;
		}

		// check that FrameworkBundle 6.3 or higher is installed
		$bundlesMetadata = $container->getParameter('kernel.bundles_metadata');
		if (!isset($bundlesMetadata['FrameworkBundle'])) {
			return false;
		}

		return is_file($bundlesMetadata['FrameworkBundle']['path'] . '/Resources/config/asset_mapper.php');
	}
}
