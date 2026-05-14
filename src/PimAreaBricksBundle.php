<?php
namespace JanWieland\PimAreaBricks;

use Pimcore\Extension\Bundle\AbstractPimcoreBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class PimAreaBricksBundle extends AbstractPimcoreBundle
{
    public function getDescription(): string
    {
        return "Jan Wieland Pimcore Area Bricks Bundle";
    }

    public function getVersion(): string
    {
        return "1.0.0";
    }

    public function getPath(): string
    {
        return realpath(\dirname(__DIR__));
    }

    /**
     * @param ContainerBuilder $container
     * @return void
     */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../config/pimcore')
        );
        $loader->load('properties.yaml');
    }
}
