<?php
namespace JanWieland\PimAreaBricks\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class PimAreaBricksExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../../config'),
        );
        $loader->load('services.yaml');
    }

    public function prepend(ContainerBuilder $container): void
    {
        $container->prependExtensionConfig('webpack_encore', [
            'builds' => [
                'pimareabricks' => '%kernel.project_dir%/public/bundles/pimareabricks',
            ],
        ]);

        $container->prependExtensionConfig('twig', [
            'paths' => [
                \dirname(__DIR__, 2) . '/templates' => 'PimAreaBricks',
                \dirname(__DIR__, 2) . '/templates' => null,
            ],
        ]);

        $container->prependExtensionConfig('framework', [
            'translator' => [
                'paths' => [
                    \dirname(__DIR__, 2) . '/translations',
                ],
            ],
        ]);

        $config = Yaml::parseFile(__DIR__ . '/../../config/pimcore/image-thumbnails.yaml');
        $container->prependExtensionConfig('pimcore', $config['pimcore']);
    }
}
