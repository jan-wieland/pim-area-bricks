<?php

namespace JanWieland\PimAreaBricks\Document\Areabrick\Example;

use Pimcore\Extension\Document\Areabrick\AbstractTemplateAreabrick;
use Pimcore\Model\Document\Editable\Area\Info;

class ExampleBrick extends AbstractTemplateAreabrick
{
    public function getId(): string
    {
        return 'jw-example';
    }

    public function getName(): string
    {
        return 'Example Brick';
    }

    public function getDescription(): string
    {
        return 'Ein einfacher Beispiel-Brick';
    }

    public function getVersion(): string
    {
        return '1.0.0';
    }

    /**
     * Wird aufgerufen bevor das Template gerendert wird.
     * Hier können Daten vorbereitet und ans Template übergeben werden.
     */
    public function action(Info $info): void
    {
        $info->setParam('headline', 'Hallo aus dem Example Brick!');
        $info->setParam('subline', 'Hier kannst du deine Daten übergeben.');
    }

    /**
     * Template-Pfad – Pimcore sucht automatisch in:
     * Resources/views/areas/{getId()}/view.html.twig
     */
    public function getTemplateLocation(): string
    {
        return static::TEMPLATE_LOCATION_BUNDLE;
    }

    public function getTemplateSuffix(): string
    {
        return static::TEMPLATE_SUFFIX_TWIG;
    }
}
