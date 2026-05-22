<?php
namespace JanWieland\PimAreaBricks;

use Pimcore\Extension\Bundle\AbstractPimcoreBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Pimcore\Extension\Bundle\PimcoreBundleAdminClassicInterface;
use Pimcore\Extension\Bundle\Traits\BundleAdminClassicTrait;

class PimAreaBricksBundle extends AbstractPimcoreBundle implements PimcoreBundleAdminClassicInterface
{
    use BundleAdminClassicTrait;

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return "Jan Wieland Pimcore Area Bricks Bundle";
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return "1.0.0";
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return realpath(\dirname(__DIR__));
    }

    /**
     * @return Installer
     */
    public function getInstaller(): Installer
    {
        return $this->container->get(Installer::class);
    }

    public function getJsPaths(): array
    {
        return [
            '/bundles/pimareabricks/js/admin/theme-context-menu.js'
        ];
    }

    public function getCssPaths(): array
    {
        return [];
    }

    public function getEditmodeJsPaths(): array
    {
        return [];
    }

    public function getEditmodeCssPaths(): array
    {
        return [];
    }
}
