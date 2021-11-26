const elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
	mix.sass('app.scss');
	mix.copy('resources/assets/vendor/bootstrap/fonts', 'public/fonts');
	mix.copy('resources/assets/vendor/font-awesome/fonts', 'public/fonts')
	mix.copy('resources/assets/webfonts', 'public/webfonts')
	mix.styles([
		'resources/assets/vendor/bootstrap/css/bootstrap.css',
		'resources/assets/vendor/animate/animate.css',
		'resources/assets/vendor/font-awesome/css/fontawesome-all.css',
	], 'public/css/vendor.css', './');
	mix.scripts([
		'resources/assets/vendor/bootstrap/js/bootstrap.js',
		'resources/assets/vendor/metisMenu/jquery.metisMenu.js',
		'resources/assets/vendor/slimscroll/jquery.slimscroll.min.js',
		'resources/assets/vendor/pace/pace.min.js',
		'resources/assets/js/inspinia.js',
		'resources/assets/js/mask.js',
		'resources/assets/lib/jquery.inputmask.min.js',
		'resources/assets/lib/doT.min.js',
		'resources/assets/lib/populate.js',
		'resources/assets/lib/serialize.js',
		'resources/assets/js/scripts.js',
		'resources/assets/js/app.js'
	], 'public/js/app.js', './');

});
