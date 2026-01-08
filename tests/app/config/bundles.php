<?php
/**
 * Copyright 2024-2026 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 08/01/2026, 13:31
 *
 * @project IDMarinas Ui Bundle
 * @see     https://github.com/idmarinas/ui-bundle
 *
 * @file    bundles.php
 * @date    05/03/2025
 * @time    15:51
 *
 * @author  Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since   1.0.0
 */

use DAMA\DoctrineTestBundle\DAMADoctrineTestBundle;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle;
use Idm\Bundle\Ui\IdmUiBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MakerBundle\MakerBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\UX\Icons\UXIconsBundle;
use Symfony\UX\TwigComponent\TwigComponentBundle;
use Twig\Extra\TwigExtraBundle\TwigExtraBundle;
use Zenstruck\Foundry\ZenstruckFoundryBundle;

return [
	FrameworkBundle::class        => ['all' => true],
	DoctrineBundle::class         => ['all' => true],
	TwigBundle::class             => ['all' => true],
	TwigExtraBundle::class        => ['all' => true],
	TwigComponentBundle::class    => ['all' => true],
	UXIconsBundle::class          => ['all' => true],

	// Dev-Test Bundles
	MakerBundle::class            => ['all' => true],
	DoctrineFixturesBundle::class => ['all' => true],
	DAMADoctrineTestBundle::class => ['all' => true],
	ZenstruckFoundryBundle::class => ['all' => true],

	// This Bundle
	IdmUiBundle::class            => ['all' => true],
];
