<?php
namespace JanWieland\PimAreaBricks\Document\Areabrick;

use Pimcore\Extension\Document\Areabrick\AbstractTemplateAreabrick;
use Pimcore\Extension\Document\Areabrick\EditableDialogBoxConfiguration;
use Pimcore\Extension\Document\Areabrick\EditableDialogBoxInterface;
use Pimcore\Model\Document\Editable;
use Pimcore\Model\Document\Editable\Area\Info;
use JanWieland\PimAreaBricks\Service\BricksService;
use Symfony\Component\HttpFoundation\Response;

class JwpimareaImage extends AbstractTemplateAreabrick implements EditableDialogBoxInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return BricksService::transAdmin('jwPimAreas.image.plural');
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
        return '/bundles/pimareabricks/images/editmode/image-outline.svg';
    }

    /**
     * @param Info $info
     * @return Response|null
     */
    public function action(Info $info): ?Response
    {
        $document = $info->getDocument();

        return null;
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

    /**
     * @param Editable $area
     * @param Info|null $info
     */
    public function getEditableDialogBoxConfiguration(Editable $area, ?Info $info): EditableDialogBoxConfiguration
    {
        $config = new EditableDialogBoxConfiguration();
        $config->setWidth(640);
        $config->setHeight(480);
        $config->setReloadOnClose(true);
        $config->setItems([
            'type' => 'tabpanel',
            'items' => array_merge(
                BricksService::tabImages(),
                [
                    [
                        'type' => 'panel',
                        'title' => BricksService::transAdmin('jwPimAreas.groups.options'),
                        'items' => BricksService::itemsImageSlideOptions(),
                    ],
                ],
                BricksService::tabLayout(),
            ),
        ]);

        return $config;
    }
}
