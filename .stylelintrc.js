module.exports = {
	extends: [ '@wordpress/stylelint-config/stylistic' ],
	ignoreFiles: [
		'assets/lib/**/*.css',
	],
	rules: {
		'font-weight-notation': null,
		'selector-class-pattern': null,
		'selector-id-pattern': null,
	},
};
