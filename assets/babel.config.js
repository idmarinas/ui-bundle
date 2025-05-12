/**
 * Copyright 2025 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 12/05/2025, 18:03
 *
 * @project IDMarinas Ui Bundle
 * @see https://github.com/idmarinas/ui-bundle
 *
 * @file babel.config.js
 * @date 12/05/2025
 * @time 18:25
 *
 * @author Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since 1.0.0
 */

module.exports = {
	presets: [
		['@babel/preset-env', {'loose': true, 'modules': false}],
		['@babel/preset-typescript', {allowDeclareFields: true}],
	],
	assumptions: {
		superIsCallableConstructor: false,
	},
};
