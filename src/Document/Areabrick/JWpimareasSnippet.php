<?php
namespace JanWieland\PimAreaBricks\Document\Areabrick;

use Pimcore\Extension\Document\Areabrick\AbstractTemplateAreabrick;
use Pimcore\Extension\Document\Areabrick\EditableDialogBoxConfiguration;
use Pimcore\Extension\Document\Areabrick\EditableDialogBoxInterface;
use Pimcore\Model\Document\Editable;
use Pimcore\Model\Document\Editable\Area\Info;
use JanWieland\PimAreaBricks\Service\BricksService;

class JWpimareasSnippet extends AbstractTemplateAreabrick implements EditableDialogBoxInterface
{

    /**
     * @return string
     */
    public function getName(): string
    {
        return BricksService::transAdmin('jwPimAreas.snippet.name');
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return BricksService::transAdmin('jwPimAreas.snippet.description');
    }

    /**
    * @return string
    */
    public function getTemplate(): string
    {
        return 'templates/areas/jwpimareas-snippet/view.html.twig';
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return '/bundles/pimareabricks/images/editmode/code-braces-box.svg';
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
            'items' => [
                [
                    'type' => 'checkbox',
                    'name' => 'asFlexboxGrid',
                    'label' => BricksService::transAdmin('jwPimAreas.snippet.asFlexboxGrid.label'),
                    'config' => [
                        'defaultValue' => true,
                    ],
                ],
                [
                    'type' => 'panel',
                    'title' => 'Layout',
                    'items' => [
                        [
                            'type' => 'input',
                            'name' => 'anchor',
                            'label' => 'Anker (optional)',
                        ],
                    ],
                ],
            ],
        ]);

        return $config;
    }
}
