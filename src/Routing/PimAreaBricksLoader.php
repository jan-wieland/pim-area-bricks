<?php
declare(strict_types=1);

namespace JanWieland\PimAreaBricks\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class PimAreaBricksLoader extends Loader
{
    private bool $loaded = false;

    public function load(mixed $resource, string $type = null): RouteCollection
    {
        $routes = new RouteCollection();

        if ($this->loaded) {
            return $routes;
        }

        $routes->add('jw_area_bricks_run_theme_import', new Route(
            '/admin/jwAreaBricks/run-theme-import',
            ['_controller' => 'JanWieland\PimAreaBricks\Controller\ThemeBuildController::runThemeImportAction'],
            [],
            [],
            '',
            [],
            ['POST']
        ));

        $this->loaded = true;
        return $routes;
    }

    public function supports(mixed $resource, string $type = null): bool
    {
        return $type === 'pim_area_bricks';
    }
}
