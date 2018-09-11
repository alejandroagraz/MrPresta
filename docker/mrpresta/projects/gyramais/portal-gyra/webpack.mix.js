let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass('resources/assets/sass/app.scss', 'public/css');

mix.js('resources/assets/js/app.js', 'public/js');

// Angular Global Page Files
mix.js([
    'resources/assets/js/angular/application-controller/application.module.js',
    'resources/assets/js/angular/loan-controller/loan.module.js',
    'resources/assets/js/angular/owner-controller/owner.module.js',
    'resources/assets/js/angular/profile-controller/profile.module.js',

    'resources/assets/js/angular/global-controller/global.module.js',

    'resources/assets/js/angular/global-controller/services/globalService.js',
    'resources/assets/js/angular/global-controller/controllers/globalCtrl.js'
], 'public/js/angular/global.js');

// Angular Owners Page Files
mix.js([
    'resources/assets/js/angular/owner-controller/services/ownerService.js',
    'resources/assets/js/angular/owner-controller/controllers/ownerCtrl.js'
], 'public/js/angular/owner.js');


// Angular Applications Page Files
mix.js([
    'resources/assets/js/angular/application-controller/services/applicationService.js',
    'resources/assets/js/angular/application-controller/services/scsTokenService.js',
    'resources/assets/js/angular/application-controller/controllers/applicationCtrl.js'

], 'public/js/angular/application.js');

// Angular Profile Page Files
mix.js([
    'resources/assets/js/angular/profile-controller/services/profileService.js',
    'resources/assets/js/angular/profile-controller/controllers/profileCtrl.js'
], 'public/js/angular/profile.js');

// Angular Loans Page Files
mix.js([
    'resources/assets/js/angular/application-controller/services/scsTokenService.js',
    'resources/assets/js/angular/loan-controller/services/loanService.js',
    'resources/assets/js/angular/loan-controller/controllers/loanCtrl.js'
], 'public/js/angular/loan.js');