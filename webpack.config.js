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

  // PostCSS (for tailwind CSS 4)
  .enablePostCssLoader()

  // Copy files from assets into build and make them usable
  .copyFiles({
    from: "./assets/editmode",
    to: "images/editmode/[path][name].[ext]",
  })
  .setPublicPath("/bundles/pimareatbricks");

module.exports = Encore.getWebpackConfig();
