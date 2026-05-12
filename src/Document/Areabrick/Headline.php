<?php
namespace JanWieland\PimAreaBricks\Document\Areabrick;

use Pimcore\Extension\Document\Areabrick\AbstractTemplateAreabrick;
use Pimcore\Extension\Document\Areabrick\EditableDialogBoxConfiguration;
use Pimcore\Extension\Document\Areabrick\EditableDialogBoxInterface;
use Pimcore\Model\Document\Editable;
use Pimcore\Model\Document\Editable\Area\Info;
use Symfony\Component\HttpFoundation\Response;
use JanWieland\PimAreaBricks\Service\BricksService;

class Headline extends AbstractTemplateAreabrick implements
    EditableDialogBoxInterface
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
    public function getTemplatePath(): string
    {
        return 'areas/headline/view.html.twig';
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return '/bundles/pimareabricks/images/editmode/format-header.svg';
    }

    /**
     * @param Info $info
     * @return Response|null
     */
    public function action(Info $info): ?Response
    {
        $document = $info->getDocument();

        $size = $document->getEditable('headlineSize')?->getData() ?: 'h2';
        $style = $document->getEditable('headlineStyle')?->getData() ?: 'auto';
        $subStyle =
            $document->getEditable('headlineSubSize')?->getData() ?: 'auto';

        $info->setParam('size', $size);
        $info->setParam('subSize', 'h' . ((int) substr($size, 1) + 1));
        $info->setParam(
            'hClass',
            $style !== 'auto' ? sprintf(' class="%s"', $style) : '',
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
