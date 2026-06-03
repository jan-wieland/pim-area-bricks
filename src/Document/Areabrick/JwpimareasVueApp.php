<?php
namespace JanWieland\PimAreaBricks\Document\Areabrick;

use Pimcore\Extension\Document\Areabrick\AbstractTemplateAreabrick;
use Pimcore\Extension\Document\Areabrick\EditableDialogBoxConfiguration;
use Pimcore\Extension\Document\Areabrick\EditableDialogBoxInterface;
use Pimcore\Model\Document\Editable;
use Pimcore\Model\Document\Editable\Area\Info;
use Symfony\Component\HttpFoundation\Response;
use JanWieland\PimAreaBricks\Service\BricksService;
use JanWieland\PimAreaBricks\Service\OptionsService;

class JwpimareasVueApp extends AbstractTemplateAreabrick implements EditableDialogBoxInterface
{
    public function __construct(
        private readonly OptionsService $optionsService
    ) {}

    /**
     * @return string
     */
    public function getName(): string
    {
        return BricksService::transAdmin('jwPimAreas.vueApp.name');
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
        return '/bundles/pimareabricks/images/editmode/vuejs.svg';
    }

    /**
     * @param Info $info
     * @return Response|null
     */
    public function action(Info $info): ?Response
    {
        $params = $this->optionsService->getOptionsByInfo($info);
        foreach ($params as $key => $value) {
            $info->setParam($key, $value);
        }

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
            'items' => [array_merge(
                    [
                        'type' => 'panel',
                        'title' => BricksService::transAdmin('jwPimAreas.groups.options'),
                        'items' => [
                            [
                                'type' => 'input',
                                'name' => 'vueAppKey',
                                'label' => BricksService::transAdmin('jwPimAreas.vueApp.name'),
                            ],
                            [
                                'type' => 'checkbox',
                                'name' => 'waitSpinner',
                                'label' => BricksService::transAdmin('jwPimAreas.vueApp.waitSpinner'),
                                'config' => [
                                    'defaultValue' => true,
                                ],
                            ],
                            [
                                'type' => 'input',
                                'name' => 'anchor',
                                'label' => BricksService::transAdmin('jwPimAreas.anchor.optional'),
                            ],
                        ],
                    ],
                    BricksService::tabLayout(),
                ),
            ],
        ]);

        return $config;
    }
}
