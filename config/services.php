<?php
/**
 * Copyright 2024-2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 06/03/2025, 11:45
 *
 * @project IDMarinas Ui Bundle
 * @see     https://github.com/idmarinas/ui-bundle
 *
 * @file    services.php
 * @date    05/03/2025
 * @time    15:51
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Idm\Bundle\Ui\Twig\Component\Element\Alert;

return function (ContainerConfigurator $container) {
	// @formatter:off
	$container->services()
		->set('.idm_ui.twig_component.element.alert', Alert::class)
			->tag('twig.component')
			->arg('$translator', service('translator')->nullOnInvalid())
	;
	// @formatter::on
};
