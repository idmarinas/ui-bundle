/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 13/05/2025, 16:57
 *
 * @project IDMarinas Ui Bundle
 * @see https://github.com/idmarinas/ui-bundle
 *
 * @file theme_toggle.ts
 * @date 11/05/2025
 * @time 23:49
 *
 * @author Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since 1.0.0
 */

import {Controller} from '@hotwired/stimulus';

export default class extends Controller<HTMLFormElement> {
	private timeout: number | undefined;

	initialize() {
		super.initialize();
		if (undefined === localStorage.theme) {
			localStorage.theme = this.userTheme();
			document.getElementById('theme-toggle-sun-moon-icon').classList.toggle('hidden', true);
		}

		this.changeTheme(localStorage.theme);
	}

	toggle(): void {
		const theme: 'dark' | 'light' = localStorage.theme === 'dark' ? 'light' : 'dark';

		this.changeTheme(theme);
	}

	private changeTheme(theme: 'dark' | 'light'): void {
		clearTimeout(this.timeout);

		localStorage.theme = theme;

		this.timeout = setTimeout(() => {
			document.documentElement.classList.toggle('dark', theme === 'dark');
			document.getElementById('theme-toggle-sun-icon').classList.toggle('hidden', theme !== 'light');
			document.getElementById('theme-toggle-moon-icon').classList.toggle('hidden', theme !== 'dark');
		}, 250);
	}

	private userTheme(): 'dark' | 'light' {
		return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
	}
}
