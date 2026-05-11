const Encore = require("@symfony/webpack-encore");

if (!Encore.isRuntimeEnvironmentConfigured()) {
  Encore.configureRuntimeEnvironment(process.env.NODE_ENV || "dev");
}

Encore.setOutputPath("src/Resources/public/")
  .setPublicPath("/bundles/pimareatbricks")
  .setManifestKeyPrefix("bundles/pimareatbricks")

  .addEntry("pimAreatBricks", "./assets/app.js")

  .disableSingleRuntimeChunk()
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())

  // SCSS
  .enableSassLoader()

  // PostCSS (für Tailwind CSS 4)
  .enablePostCssLoader();

module.exports = Encore.getWebpackConfig();
