/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 12/05/2025, 22:23
 *
 * @project IDMarinas Ui Bundle
 * @see https://github.com/idmarinas/ui-bundle
 *
 * @file loader.ts
 * @date 12/05/2025
 * @time 24:30
 *
 * @author Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since 1.0.0
 */

import {Application} from "@hotwired/stimulus";
import Notification from '@stimulus-components/notification';
import ThemeToggle from './theme_toggle.js';

export default function registerIdmUiBundle(app: Application) {
	app.register('notification', Notification);
	app.register('theme-toggle', ThemeToggle);
}
