<?php
namespace JanWieland\PimAreaBricks;

use Pimcore\Extension\Bundle\AbstractPimcoreBundle;

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
}
