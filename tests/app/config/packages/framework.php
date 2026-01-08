<?php
/**
 * Copyright 2024-2026 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 08/01/2026, 13:36
 *
 * @project IDMarinas Ui Bundle
 * @see     https://github.com/idmarinas/ui-bundle
 *
 * @file    framework.php
 * @date    05/03/2025
 * @time    15:51
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container) {
	$container->extension('framework', [
		'secret'                => 'test',
		'http_method_override'  => false,
		'test'                  => true,
		'default_locale'        => 'en',
		'enabled_locales'       => [
			0 => 'en',
		],
		'handle_all_throwables' => true,
		'csrf_protection'       => [
			'enabled' => false,
		],
		'form'                  => [
			'enabled'         => false,
			'csrf_protection' => [
				'enabled' => true,
			],
		],
		'http_cache'            => [
			'enabled' => false,
			'debug'   => true,
		],
		'router'                => [
			'enabled' => true,
			'utf8'    => true,
		],
		'session'               => [
			'enabled'         => false,
			'handler_id'      => null,
			'cookie_secure'   => true,
			'cookie_samesite' => 'lax',
		],
		'assets'                => [
			'enabled' => false,
		],
		'validation'            => [
			'enabled'                  => false,
			'email_validation_mode'    => 'html5',
			'not_compromised_password' => [
				'enabled' => false,
			],
		],
		'property_access'       => [
			'enabled' => true,
		],
		'php_errors'            => [
			'log' => true,
		],
		'messenger'             => [
			'enabled'    => false,
			'routing'    => [
				'Symfony\Component\Mailer\Messenger\SendEmailMessage' => [
					'senders' => [
						0 => 'sync',
					],
				],
			],
			'transports' => [
				'sync' => 'in-memory://',
			],
		],
		'mailer'                => [
			'enabled'  => false,
			'dsn'      => false,
			'envelope' => [
				'sender' => 'idm_bundle@test.bundle',
			],
			'headers'  => [
				'From' => 'IDMarinas Seo Bundle <idm_bundle@test.bundle>',
			],
		],
		'uid'                   => [
			'enabled'                 => false,
			'default_uuid_version'    => 7,
			'time_based_uuid_version' => 7,
		],

	]);
};
