<?php
namespace JanWieland\PimAreaBricks\Document\Areabrick;

use Pimcore\Extension\Document\Areabrick\AbstractTemplateAreabrick;
use JanWieland\PimAreaBricks\Service\BricksService;

class JwpimareaTexteditor extends AbstractTemplateAreabrick
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return BricksService::transAdmin('jwPimAreas.texteditor.name');
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return '/bundles/pimareabricks/images/editmode/text-box-edit-outline.svg';
    }

    /**
     * @return bool
     */
    public function needsReload(): bool
    {
        // optional
        // here you can decide whether adding this bricks should trigger a reload
        // in the editing interface, this could be necessary in some cases. default=false
        return false;
    }
}
