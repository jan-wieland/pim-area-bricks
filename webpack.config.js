const Encore = require('@symfony/webpack-encore')

if (!Encore.isRuntimeEnvironmentConfigured()) {
  Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev')
}

Encore.setOutputPath('public/')
  .setPublicPath('/bundles/pimareabricks')
  .setManifestKeyPrefix('bundles/pimareabricks')

  .addEntry('pimAreaBricksApp', './assets/app.js')
  .addEntry('pimAreaBricksEditmode', './assets/editmode.js')
  .addEntry('pimAreaBricksDocs', './assets/docs.js')

  .disableSingleRuntimeChunk()
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())

  // SCSS
  .enableSassLoader()

  // PostCSS (for tailwind CSS 4)
  .enablePostCssLoader()

  // Copy files from assets into build and make them usable
  .copyFiles({
    from: './assets/editmode',
    to: 'images/editmode/[path][name].[ext]',
  })
  .copyFiles({
    from: './assets/scripts/admin',
    to: 'js/admin/[name].[ext]',
  })
  .setPublicPath('/bundles/pimareabricks')

module.exports = Encore.getWebpackConfig()
