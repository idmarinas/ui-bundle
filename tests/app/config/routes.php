<?php
/**
 * Copyright 2025-2026 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 06/01/2026, 19:52
 *
 * @project IDMarinas Ui Bundle
 * @see     https://github.com/idmarinas/ui-bundle
 *
 * @file    routes.php
 * @date    26/11/2025
 * @time    16:03
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

use Symfony\Bundle\FrameworkBundle\Controller\TemplateController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
	// @formatter:off
//	$routes->import('routes/web_profiler.php');

	//$routes->import('security.route_loader.logout', 'service')->methods(['GET']);

	$routes->add('app_home', '/')
		->controller(TemplateController::class)
		->methods(['GET'])
		->defaults(['template' => 'pages/home.html.twig'])
		->options([
			'seo' => true
		])
	;
	// @formatter:on
};
