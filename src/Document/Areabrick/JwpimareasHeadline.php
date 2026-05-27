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

class JwpimareasHeadline extends AbstractTemplateAreabrick implements EditableDialogBoxInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return BricksService::transAdmin('jwPimAreas.headline.name');
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
        return '/bundles/pimareabricks/images/editmode/format-header-2.svg';
    }

    /**
     * @param Info $info
     * @return Response|null
     */
    public function action(Info $info): ?Response
    {
        $params = OptionsService::getOptionsByInfo($info);

        foreach ($params as $key => $value) {
            $info->setParam($key, $value);
        }
        /*
        $document = $info->getDocument();

        $hSize = $document->getEditable('headlineSize')?->getData() ?: 'h2';
        $style = $document->getEditable('headlineStyle')?->getData() ?: 'auto';
        $subStyle = $document->getEditable('headlineSubSize')?->getData() ?: 'auto';

        $info->setParam('hSize', $hSize);
        $info->setParam('hSubSize', 'h' . ((int) substr(hSize, 1) + 1));
        $info->setParam(
            'hClass',
            $style !== 'auto' || Editable::isInEditMode() ? sprintf(
                ' class="%s%s"',
                ($style !== 'auto' ? $style : ''),
                (Editable::isInEditMode() ? ' m-0' : '')
            ) : '')
        );
        $info->setParam(
            'subClass',
            $style !== 'auto'
                ? sprintf(
                    ' class="%s"',
                    $subStyle === 'auto'
                        ? 'h' . ((int) substr($style, 1) + 1)
                        : $subStyle,
                )
                : '',
        );
        */

        return null;
    }

    /**
     * @param Info $info
     * @return string
     */
    public function getHtmlTagOpen(Info $info): string
    {
        return BricksService::buildHtmlTagOpen($info);
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
    public function getEditableDialogBoxConfiguration(
        Editable $area,
        ?Info $info,
    ): EditableDialogBoxConfiguration {
        $config = new EditableDialogBoxConfiguration();
        $config->setWidth(640);
        $config->setHeight(480);
        $config->setReloadOnClose(true);
        $config->setItems([
            'type' => 'tabpanel',
            'items' => array_merge(
                [
                    [
                        'type' => 'panel',
                        'title' => BricksService::transAdmin(
                            'jwPimAreas.groups.options',
                        ),
                        'items' => BricksService::itemsHeadline(),
                    ],
                ],
                BricksService::tabLayout(),
            ),
        ]);

        return $config;
    }
}
