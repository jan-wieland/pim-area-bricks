<?php
namespace JanWieland\PimAreaBricks;

use Pimcore\Extension\Bundle\AbstractPimcoreBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class PimAreaBricksBundle extends AbstractPimcoreBundle
{
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
}
