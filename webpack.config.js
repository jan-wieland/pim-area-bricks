const Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'development');
}

Encore
    .setOutputPath('src/Resources/public/')
    .setPublicPath('/bundles/pimareatbricks')
    .setManifestKeyPrefix('bundles/pimareatbricks')

    .addEntry('app', './assets/js/app.js')
    .addStyleEntry('styles', './assets/scss/app.scss')

    .disableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    // SCSS
    .enableSassLoader()

    // PostCSS (für Tailwind CSS 4)
    .enablePostCssLoader()
;

module.exports = Encore.getWebpackConfig();
