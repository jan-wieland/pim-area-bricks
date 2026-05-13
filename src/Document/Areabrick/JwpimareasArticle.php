<?php
namespace JanWieland\PimAreaBricks\Document\Areabrick;

use Pimcore\Extension\Document\Areabrick\AbstractTemplateAreabrick;
use JanWieland\PimAreaBricks\Service\BricksService;

class JwpimareaArticle extends AbstractTemplateAreabrick
{

    /**
     * @return string
     */
    public function getName(): string
    {
        return BricksService::transAdmin('jwPimAreas.article.name');
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'HTML article';
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return '/bundles/pimareabricks/images/editmode/text-box-outline.svg';
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
