<?php
namespace JanWieland\PimAreaBricks\Service;

use Pimcore\Model\Document\Editable\Area\Info;
use Pimcore\Tool\Authentication;

class BricksService
{
    private static string $language = 'en';
    private const SUPPORTED_LANGUAGES = ['de', 'en'];

    public function __construct()
    {
        $language = Authentication::authenticateSession()?->getLanguage() ?? 'en';
        self::$language = in_array($language, self::SUPPORTED_LANGUAGES, true) ? $language : 'en';
    }

    /**
     * @param string $transKey
     * @return string
     */
    public static function transAdmin(string $transKey): string
    {
        return \Pimcore::getContainer()->get('translator')->trans($transKey, [], 'admin', self::$language);
    }

    /**
     * @param bool $short
     * @return array
     */
    public static function tabDesign(bool $short = false): array
    {
        return [[
            'type' => 'panel',
            'title' => self::transAdmin('jwPimAreas.groups.design'),
            'items' => [
                [
                    'type' => 'select',
                    'name' => 'boxStyle',
                    'label' => self::transAdmin('jwPimAreas.prams.boxStyle.label'),
                    'config' => [
                        'store' => [
                            ['none', self::transAdmin('jwPimAreas.prams.boxStyle.options.none')],
                            ['default', self::transAdmin('jwPimAreas.prams.boxStyle.options.default')],
                            ['image-left', self::transAdmin('jwPimAreas.prams.boxStyle.options.image-left')],
                            ['image-right', self::transAdmin('jwPimAreas.prams.boxStyle.options.image-right')],
                            ['tile', self::transAdmin('jwPimAreas.prams.boxStyle.options.tile')],
                            ['rotating-tile', self::transAdmin('jwPimAreas.prams.boxStyle.options.rotating-tile')],
                        ],
                        'defaultValue' => 'none',
                        'width' => 300,
                    ],
                ],
            ],
        ]];
    }

    /**
     * @param bool $short
     * @return array
     */
    public static function tabLayout(bool $short = false): array
    {
        return [[
            'type' => 'panel',
            'title' => self::transAdmin('jwPimAreas.groups.layout'),
            'items' => [
                [
                    'type' => 'select',
                    'name' => 'gridColumns',
                    'label' => self::transAdmin('jwPimAreas.prams.gridColumns.label'),
                    'config' => [
                        'store' => [
                            ['none', self::transAdmin('jwPimAreas.prams.gridColumns.options.none')],
                            ['2', self::transAdmin('jwPimAreas.prams.gridColumns.options.2')],
                            ['3', self::transAdmin('jwPimAreas.prams.gridColumns.options.3')],
                            ['4', self::transAdmin('jwPimAreas.prams.gridColumns.options.4')],
                            ['5', self::transAdmin('jwPimAreas.prams.gridColumns.options.5')],
                            ['6', self::transAdmin('jwPimAreas.prams.gridColumns.options.6')],
                            ['auto', self::transAdmin('jwPimAreas.prams.gridColumns.options.auto')],
                        ],
                        'defaultValue' => 'none',
                        'width' => 300,
                    ],
                ],
                [
                    'type' => 'select',
                    'name' => 'girdBreakpoints',
                    'label' => self::transAdmin('jwPimAreas.prams.girdBreakpoints.label'),
                    'config' => [
                        'store' => [
                            ['early', self::transAdmin('jwPimAreas.prams.girdBreakpoints.options.early')],
                            ['normal', self::transAdmin('jwPimAreas.prams.girdBreakpoints.options.normal')],
                            ['late', self::transAdmin('jwPimAreas.prams.girdBreakpoints.options.late')],
                        ],
                        'defaultValue' => 'normal',
                        'width' => 300,
                    ],
                ],
                [
                    'type' => 'select',
                    'name' => 'endsGridRow',
                    'label' => self::transAdmin('jwPimAreas.prams.endsGridRow.label'),
                    'config' => [
                        'store' => [
                            ['yes', self::transAdmin('jwPimAreas.prams.endsGridRow.options.yes')],
                            ['no', self::transAdmin('jwPimAreas.prams.endsGridRow.options.no')],
                        ],
                        'defaultValue' => 'no',
                        'width' => 300,
                    ],
                ],
                [
                    'type' => 'select',
                    'name' => 'gridItemVertical',
                    'label' => self::transAdmin('jwPimAreas.prams.gridItemVertical.label'),
                    'config' => [
                        'store' => [
                            ['none', self::transAdmin('jwPimAreas.prams.gridItemVertical.options.none')],
                            ['top', self::transAdmin('jwPimAreas.prams.gridItemVertical.options.top')],
                            ['bottom', self::transAdmin('jwPimAreas.prams.gridItemVertical.options.bottom')],
                        ],
                        'defaultValue' => 'none',
                        'width' => 300,
                    ],
                ],
                [
                    'type' => 'select',
                    'name' => 'spaceBefore',
                    'label' => self::transAdmin('jwPimAreas.prams.space.before'),
                    'config' => [
                        'store' => [
                            ['none', self::transAdmin('jwPimAreas.prams.space.options.none')],
                            ['extra-small', self::transAdmin('jwPimAreas.prams.space.options.extra-small')],
                            ['small', self::transAdmin('jwPimAreas.prams.space.options.small')],
                            ['medium', self::transAdmin('jwPimAreas.prams.space.options.medium')],
                            ['large', self::transAdmin('jwPimAreas.prams.space.options.large')],
                            ['extra-large', self::transAdmin('jwPimAreas.prams.space.options.extra-large')],
                        ],
                        'defaultValue' => 'none',
                    ],
                ],
                [
                    'type' => 'select',
                    'name' => 'spaceAfter',
                    'label' => self::transAdmin('jwPimAreas.prams.space.after'),
                    'config' => [
                        'store' => [
                            ['none', self::transAdmin('jwPimAreas.prams.space.options.none')],
                            ['extra-small', self::transAdmin('jwPimAreas.prams.space.options.extra-small')],
                            ['small', self::transAdmin('jwPimAreas.prams.space.options.small')],
                            ['medium', self::transAdmin('jwPimAreas.prams.space.options.medium')],
                            ['large', self::transAdmin('jwPimAreas.prams.space.options.large')],
                            ['extra-large', self::transAdmin('jwPimAreas.prams.space.options.extra-large')],
                        ],
                        'defaultValue' => 'none',
                    ],
                ],
                [
                    'type' => 'input',
                    'name' => 'anchor',
                    'label' => self::transAdmin('jwPimAreas.anchor.optional'),
                ],
                [
                    'type' => 'input',
                    'name' => 'anchorTitle',
                    'label' => self::transAdmin('jwPimAreas.anchor.nav.label'),
                ],
                [
                    'type' => 'select',
                    'name' => 'anchorExclude',
                    'label' => self::transAdmin('jwPimAreas.anchor.nav.hide'),
                    'config' => [
                        'store' => [
                            ['yes', self::transAdmin('jwPimAreas.yes')],
                            ['no', self::transAdmin('jwPimAreas.no')],
                        ],
                        'defaultValue' => 'no',
                    ],
                ],
            ],
        ]];
    }

    /**
     * @return array
     */
    public static function tabLayoutAnchor(): array {
        return [[
            'type' => 'tabpanel',
            'items' => [
                [
                    'type' => 'panel',
                    'title' => self::transAdmin('jwPimAreas.groups.layout'),
                    'items' => [
                        [
                            'type' => 'input',
                            'name' => 'anchor',
                            'label' => self::transAdmin('jwPimAreas.anchor.optional'),
                        ],
                        [
                            'type' => 'input',
                            'name' => 'anchorTitle',
                            'label' => self::transAdmin('jwPimAreas.anchor.nav.label'),
                        ],
                        [
                            'type' => 'select',
                            'name' => 'anchorExclude',
                            'label' => self::transAdmin('jwPimAreas.anchor.nav.hide'),
                            'config' => [
                                'store' => [
                                    ['yes', self::transAdmin('jwPimAreas.yes')],
                                    ['no', self::transAdmin('jwPimAreas.no')],
                                ],
                                'defaultValue' => 'no',
                            ],
                        ],
                    ],
                ],
            ],
        ]];
    }

    /**
     * @return array
     */
    public static function tabImages(): array
    {
        return [[
            'type' => 'panel',
            'title' => self::transAdmin('jwPimAreas.groups.images'),
            'items' => [
            /*
                [
                    'type' => 'input',
                    'name' => 'imageAlt',
                    'label' => self::transAdmin('jwPimAreas.image.alt.label'),
                ],
                [
                    'type' => 'input',
                    'name' => 'imageCaption',
                    'label' => self::transAdmin('jwPimAreas.image.caption.label'),
                ],
                */
                [
                    'type' => 'numeric',
                    'name' => 'imageGeneralhWidth',
                    'label' => self::transAdmin('jwPimAreas.image.imageGeneralhWidth.label'),
                    'config' => [
                        'minValue' => 0,
                        'maxValue' => 3480,
                        'decimalPrecision' => 0,
                        'defaultValue' => '0',
                    ],
                ],
                [
                    'type' => 'select',
                    'name' => 'imagePos',
                    'label' => self::transAdmin('jwPimAreas.image.pos.label'),
                    'config' => [
                        'store' => [
                            ['top-left', self::transAdmin('jwPimAreas.image.pos.options.top-left')],
                            ['top-center', self::transAdmin('jwPimAreas.image.pos.options.top-center')],
                            ['top-right', self::transAdmin('jwPimAreas.image.pos.options.top-right')],
                            ['bottom-left', self::transAdmin('jwPimAreas.image.pos.options.bottom-left')],
                            ['bottom-center', self::transAdmin('jwPimAreas.image.pos.options.bottom-center')],
                            ['bottom-right', self::transAdmin('jwPimAreas.image.pos.options.bottom-right')],
                            ['float-left', self::transAdmin('jwPimAreas.image.pos.options.float-left')],
                            ['float-right', self::transAdmin('jwPimAreas.image.pos.options.float-right')],
                        ],
                        'defaultValue' => 'top-center',
                    ],
                ],
                [
                    'type' => 'select',
                    'name' => 'imagePosRelativeH',
                    'label' => self::transAdmin('jwPimAreas.image.imagePosRelativeH.label'),
                    'config' => [
                        'store' => [
                            ['before', self::transAdmin('jwPimAreas.image.imagePosRelativeH.options.before')],
                            ['after', self::transAdmin('jwPimAreas.image.imagePosRelativeH.options.after')],
                            ['introduction', self::transAdmin('jwPimAreas.image.imagePosRelativeH.options.introduction')],
                        ],
                        'defaultValue' => 'introduction',
                    ],
                ],
                [
                    'type' => 'select',
                    'name' => 'imageProportion',
                    'label' => self::transAdmin('jwPimAreas.image.proportion.label'),
                    'config' => [
                        'store' => [
                            ['16-9', self::transAdmin('jwPimAreas.image.proportion.options.16-9')],
                            ['21-9', self::transAdmin('jwPimAreas.image.proportion.options.21-9')],
                            ['32:9', self::transAdmin('jwPimAreas.image.proportion.options.32-9')],
                            ['5:7', self::transAdmin('jwPimAreas.image.proportion.options.5-7')],
                            ['1-1', self::transAdmin('jwPimAreas.image.proportion.options.1-1')],
                            ['3:2', self::transAdmin('jwPimAreas.image.proportion.options.3-2')],
                            ['2:3', self::transAdmin('jwPimAreas.image.proportion.options.2-3')],
                            ['4:5', self::transAdmin('jwPimAreas.image.proportion.options.4-5')],
                            ['none', self::transAdmin('jwPimAreas.image.proportion.options.none')],
                            ['round', self::transAdmin('jwPimAreas.image.proportion.options.round')],
                            ['round-large', self::transAdmin('jwPimAreas.image.proportion.options.round-large')],
                        ],
                        'defaultValue' => '16-9',
                    ],
                ],
            ],
        ]];
    }

    /**
     * @return array
     */
    public static function tabImageSlide(): array {
        return [[
            'type' => 'panel',
            'title' => BricksService::transAdmin('jwPimAreas.groups.imageSlide'),
            'items' => [
                [
                    'type' => 'checkbox',
                    'name' => 'imagesAsSlider',
                    'label' => self::transAdmin('jwPimAreas.image.imagesAsSlider.label'),
                    'config' => [
                        'defaultValue' => false,
                    ],
                ],
                [
                    'type' => 'select',
                    'name' => 'sliderFromBreakpoint',
                    'label' => self::transAdmin('jwPimAreas.image.sliderToBreakpoint.label'),
                    'config' => [
                        'store' => [
                            ['always', self::transAdmin('jwPimAreas.image.sliderToBreakpoint.options.always')],
                            ['sm', self::transAdmin('jwPimAreas.image.sliderToBreakpoint.options.sm')],
                            ['md', self::transAdmin('jwPimAreas.image.sliderToBreakpoint.options.md')],
                            ['lg', self::transAdmin('jwPimAreas.image.sliderToBreakpoint.options.lg')],
                            ['xl', self::transAdmin('jwPimAreas.image.sliderToBreakpoint.options.xl')],
                        ],
                        'defaultValue' => 'always',
                    ],
                ],
                [
                    'type' => 'select',
                    'name' => 'sliderImages',
                    'label' => self::transAdmin('jwPimAreas.image.sliderImages.label'),
                    'config' => [
                        'store' => [
                            ['1', self::transAdmin('jwPimAreas.image.sliderImages.options.1')],
                            ['2', self::transAdmin('jwPimAreas.image.sliderImages.options.2')],
                            ['3', self::transAdmin('jwPimAreas.image.sliderImages.options.3')],
                            ['4', self::transAdmin('jwPimAreas.image.sliderImages.options.4')],
                            ['5', self::transAdmin('jwPimAreas.image.sliderImages.options.5')],
                        ],
                        'defaultValue' => '1',
                    ],
                ],
                [
                    'type' => 'select',
                    'name' => 'sliderImagesScroll',
                    'label' => self::transAdmin('jwPimAreas.image.sliderImagesScroll.label'),
                    'config' => [
                        'store' => [
                            ['1', self::transAdmin('jwPimAreas.image.sliderImages.options.1')],
                            ['2', self::transAdmin('jwPimAreas.image.sliderImages.options.2')],
                            ['3', self::transAdmin('jwPimAreas.image.sliderImages.options.3')],
                            ['4', self::transAdmin('jwPimAreas.image.sliderImages.options.4')],
                            ['5', self::transAdmin('jwPimAreas.image.sliderImages.options.5')],
                        ],
                        'defaultValue' => '1',
                    ],
                ],
            ],
        ]];
    }

    /**
     * @return array
     */
     public static function tabTexteditor(): array {
         return [[
            'type' => 'panel',
            'title' => BricksService::transAdmin('jwPimAreas.groups.options'),
            'items' => [
                [
                    'type' => 'checkbox',
                    'name' => 'columnCount',
                    'label' => BricksService::transAdmin('jwPimAreas.texteditor.columnCount'),
                    'config' => [
                        'defaultValue' => false,
                    ],
                ],
            ],
        ]];
     }

    /**
     * @return array
     */
     public static function tabHeadline(): array {
         return [[
            'type' => 'panel',
            'title' => BricksService::transAdmin('jwPimAreas.groups.headline'),
            'items' => [
                [
                    'type' => 'select',
                    'name' => 'headlineSize',
                    'label' => self::transAdmin('jwPimAreas.headline.seo.label'),
                    'config' => [
                        'store' => [
                            ['h1', 'H1'],
                            ['h2', self::transAdmin('jwPimAreas.headline.seo.options.h2')],
                            ['h3', 'H3'],
                            ['h4', 'H4'],
                            ['h5', 'H5'],
                        ],
                        'defaultValue' => 'h2',
                    ],
                ],
                [
                    'type' => 'select',
                    'name' => 'headlineStyle',
                    'label' => self::transAdmin('jwPimAreas.headline.style.label'),
                    'config' => [
                        'store' => [
                            ['auto', self::transAdmin('jwPimAreas.headline.style.options.auto')],
                            ['h1', 'H1'],
                            ['h2', 'H2'],
                            ['h3', 'H3'],
                            ['h4', 'H4'],
                            ['h5', 'H5'],
                        ],
                        'defaultValue' => 'auto',
                        'width' => 300,
                    ],
                ],
                [
                    'type' => 'select',
                    'name' => 'headlineSubSize',
                    'label' => self::transAdmin('jwPimAreas.headline.subSize.label'),
                    'config' => [
                        'store' => [
                            ['auto', self::transAdmin('jwPimAreas.headline.subSize.options.auto')],
                            ['h1', 'H1'],
                            ['h2', 'H2'],
                            ['h3', 'H3'],
                            ['h4', 'H4'],
                            ['h5', 'H5'],
                            ['h5', 'H5'],
                            ['h6', 'H6'],
                        ],
                        'defaultValue' => 'auto',
                        'width' => 300,
                    ],
                ],
            ],
         ]];
    }

    /**
     * @param Info $info
     * @return string
     */
    public static function buildHtmlTagOpen(Info $info): string
    {
        $gridColumns = $info->getDocument()->getEditable('gridColumns')?->getData() ?? 'none';

        return sprintf(
            '<div class="%s%s%s%s">',
            'pimcore_area_',
            $info->getId(),
            ' pimcore_area_content jwpimareas-flexbox-',
            $gridColumns === 'none' ? '0' : $gridColumns
        );
    }
}
