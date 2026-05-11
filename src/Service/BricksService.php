<?php
namespace JanWieland\PimAreaBricks\Service;

class BricksService
{
    /**
     * @param string $transKey
     * @return string
     */
    public static function transAdmin(string $transKey): string
    {
        return \Pimcore::getContainer()->get('translator')->trans($transKey, [], 'admin');
    }

    /**
     * @param bool $short
     * @return array
     */
    public static function tabLayout(bool $short = false): array
    {
        return [[
            'type' => 'panel',
            'title' => self::transAdmin('areabrick.groups.layout'),
            'items' => array_merge(($short ? [] :
            [[
                'type' => 'select',
                'name' => 'gridColumns',
                'label' => self::transAdmin('areabrick.groups.prams.gridColumns.label'),
                'config' => [
                    'store' => [
                        ['none', self::transAdmin('areabrick.groups.prams.gridColumns.options.none')],
                        ['2', self::transAdmin('areabrick.groups.prams.gridColumns.options.2')],
                        ['3', self::transAdmin('areabrick.groups.prams.gridColumns.options.3')],
                        ['4', self::transAdmin('areabrick.groups.prams.gridColumns.options.4')],
                        ['5', self::transAdmin('areabrick.groups.prams.gridColumns.options.5')],
                        ['auto', self::transAdmin('areabrick.groups.prams.gridColumns.options.auto')],
                    ],
                    'defaultValue' => 'none',
                ],
            ],
            [
                'type' => 'select',
                'name' => 'gridItemVertical',
                'label' => self::transAdmin('areabrick.groups.prams.gridItemVertical.label'),
                'config' => [
                    'store' => [
                        ['none', self::transAdmin('areabrick.groups.prams.gridItemVertical.options.none')],
                        ['top', self::transAdmin('areabrick.groups.prams.gridItemVertical.options.top')],
                        ['bottom', self::transAdmin('areabrick.groups.prams.gridItemVertical.options.bottom')],
                    ],
                    'defaultValue' => 'none',
                ],
            ],
            [
                'type' => 'select',
                'name' => 'boxStyle',
                'label' => self::transAdmin('areabrick.groups.prams.boxStyle.label'),
                'config' => [
                    'store' => [
                        ['none', self::transAdmin('areabrick.groups.prams.boxStyle.options.none')],
                        ['default', self::transAdmin('areabrick.groups.prams.boxStyle.options.default')],
                        ['image-left', self::transAdmin('areabrick.groups.prams.boxStyle.options.image-left')],
                        ['image-right', self::transAdmin('areabrick.groups.prams.boxStyle.options.image-right')],
                        ['tile', self::transAdmin('areabrick.groups.prams.boxStyle.options.tile')],
                        ['rotating-tile', self::transAdmin('areabrick.groups.prams.boxStyle.options.rotating-tile')],
                    ],
                    'defaultValue' => 'none',
                    'width' => 300,
                ],
            ],
        ]),
        [[
            'type' => 'select',
            'name' => 'spaceBefore',
            'label' => self::transAdmin('areabrick.groups.prams.space.before'),
            'config' => [
                'store' => [
                    ['none', self::transAdmin('areabrick.groups.prams.space.options.none')],
                    ['extra-small', self::transAdmin('areabrick.groups.prams.space.options.extra-small')],
                    ['small', self::transAdmin('areabrick.groups.prams.space.options.small')],
                    ['medium', self::transAdmin('areabrick.groups.prams.space.options.medium')],
                    ['large', self::transAdmin('areabrick.groups.prams.space.options.large')],
                    ['extra-large', self::transAdmin('areabrick.groups.prams.space.options.extra-large')],
                ],
                'defaultValue' => 'none',
            ],
        ],
        [
            'type' => 'select',
            'name' => 'spaceAfter',
            'label' => self::transAdmin('areabrick.groups.prams.space.after'),
            'config' => [
                'store' => [
                    ['none', self::transAdmin('areabrick.groups.prams.space.options.none')],
                    ['extra-small', self::transAdmin('areabrick.groups.prams.space.options.extra-small')],
                    ['small', self::transAdmin('areabrick.groups.prams.space.options.small')],
                    ['medium', self::transAdmin('areabrick.groups.prams.space.options.medium')],
                    ['large', self::transAdmin('areabrick.groups.prams.space.options.large')],
                    ['extra-large', self::transAdmin('areabrick.groups.prams.space.options.extra-large')],
                ],
                'defaultValue' => 'none',
            ],
        ],
        [
            'type' => 'input',
            'name' => 'anchor',
            'label' => self::transAdmin('areabrick.anchor.otional'),
        ],
        ]),
        ]];
    }

    /**
     * @return array
     */
    public static function tabImages(): array
    {
        return [
            [
                'type' => 'panel',
                'title' => self::transAdmin('areabrick.groups.images'),
                'items' => [
                    [
                        'type' => 'input',
                        'name' => 'imageAlt',
                        'label' => self::transAdmin('areabrick.image.alt.label'),
                    ],
                    [
                        'type' => 'input',
                        'name' => 'imageCaption',
                        'label' => self::transAdmin('areabrick.image.caption.label'),
                    ],
                    [
                        'type' => 'select',
                        'name' => 'imagePos',
                        'label' => self::transAdmin('areabrick.image.pos.label'),
                        'config' => [
                            'store' => [
                                ['top-left', self::transAdmin('areabrick.image.pos.options.top-left')],
                                ['top-center', self::transAdmin('areabrick.image.pos.options.top-center')],
                                ['top-right', self::transAdmin('areabrick.image.pos.options.top-right')],
                                ['bottom-left', self::transAdmin('areabrick.image.pos.options.bottom-left')],
                                ['bottom-center', self::transAdmin('areabrick.image.pos.options.bottom-center')],
                                ['bottom-right', self::transAdmin('areabrick.image.pos.options.bottom-right')],
                                ['float-left', self::transAdmin('areabrick.image.pos.options.float-left')],
                                ['float-right', self::transAdmin('areabrick.image.pos.options.float-right')],
                            ],
                            'defaultValue' => 'top-center',
                        ],
                    ],
                    [
                        'type' => 'select',
                        'name' => 'imagePosRelativeH',
                        'label' => self::transAdmin('areabrick.image.imagePosRelativeH.label'),
                        'config' => [
                            'store' => [
                                ['before', self::transAdmin('areabrick.image.imagePosRelativeH.options.before')],
                                ['after', self::transAdmin('areabrick.image.imagePosRelativeH.options.after')],
                                ['introduction', self::transAdmin('areabrick.image.imagePosRelativeH.options.introduction')],
                            ],
                            'defaultValue' => 'introduction',
                        ],
                    ],
                    [
                        'type' => 'select',
                        'name' => 'imageProportion',
                        'label' => self::transAdmin('areabrick.image.proportion.label'),
                        'config' => [
                            'store' => [
                                ['16-9', self::transAdmin('areabrick.image.proportion.options.16-9')],
                                ['21-9', self::transAdmin('areabrick.image.proportion.options.21-9')],
                                ['32:9', self::transAdmin('areabrick.image.proportion.options.32-9')],
                                ['5:7', self::transAdmin('areabrick.image.proportion.options.5-7')],
                                ['1-1', self::transAdmin('areabrick.image.proportion.options.1-1')],
                                ['3:2', self::transAdmin('areabrick.image.proportion.options.3-2')],
                                ['2:3', self::transAdmin('areabrick.image.proportion.options.2-3')],
                                ['4:5', self::transAdmin('areabrick.image.proportion.options.4-5')],
                                ['none', self::transAdmin('areabrick.image.proportion.options.none')],
                                ['round', self::transAdmin('areabrick.image.proportion.options.round')],
                                ['round-large', self::transAdmin('areabrick.image.proportion.options.round-large')],
                            ],
                            'defaultValue' => 'introduction',
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public static function itemsImageSlideOptions(): array {
        return [[
            'type' => 'checkbox',
            'name' => 'imagesAsSlider',
            'label' => self::transAdmin('areabrick.image.imagesAsSlider.label'),
            'config' => [
                'defaultValue' => false,
            ],
        ],
        [
            'type' => 'select',
            'name' => 'sliderToBreakpoint',
            'label' => self::transAdmin('areabrick.image.sliderToBreakpoint.label'),
            'config' => [
                'store' => [
                    ['always', self::transAdmin('areabrick.image.sliderToBreakpoint.options.always')],
                    ['sm', self::transAdmin('areabrick.image.sliderToBreakpoint.options.sm')],
                    ['md', self::transAdmin('areabrick.image.sliderToBreakpoint.options.md')],
                    ['lg', self::transAdmin('areabrick.image.sliderToBreakpoint.options.lg')],
                    ['xl', self::transAdmin('areabrick.image.sliderToBreakpoint.options.xl')],
                ],
                'defaultValue' => 'always',
            ],
        ],
        [
            'type' => 'select',
            'name' => 'sliderImages',
            'label' => self::transAdmin('areabrick.image.sliderImages.label'),
            'config' => [
                'store' => [
                    ['1', self::transAdmin('areabrick.image.sliderImages.options.1')],
                    ['2', self::transAdmin('areabrick.image.sliderImages.options.2')],
                    ['3', self::transAdmin('areabrick.image.sliderImages.options.3')],
                    ['4', self::transAdmin('areabrick.image.sliderImages.options.4')],
                    ['5', self::transAdmin('areabrick.image.sliderImages.options.5')],
                ],
                'defaultValue' => '1',
            ],
        ]];
    }

    /**
     * @return array
     */
     public static function itemsHeadline(): array {
         return [[
             'type' => 'select',
             'name' => 'headlineSize',
             'label' => self::transAdmin('areabrick.headline.seo.label'),
             'config' => [
                 'store' => [
                     ['h1', 'H1'],
                     ['h2', self::transAdmin('areabrick.headline.seo.options.h2')],
                     ['h3', 'H3'],
                 ],
                 'defaultValue' => 'h2',
             ],
         ],
         [
             'type' => 'select',
             'name' => 'headlineStyle',
             'label' => self::transAdmin('areabrick.headline.style.label'),
             'config' => [
                 'store' => [
                     ['auto', self::transAdmin('areabrick.headline.style.options.auto')],
                     ['h1', 'H1'],
                     ['h2', 'H2'],
                     ['h3', 'H3'],
                 ],
                 'defaultValue' => 'auto',
                 'width' => 300,
             ],
         ],
         [
             'type' => 'select',
             'name' => 'headlineSubSize',
             'label' => self::transAdmin('areabrick.headline.subSize.label'),
             'config' => [
                 'store' => [
                     ['auto', self::transAdmin('areabrick.headline.subSize.options.auto')],
                     ['h1', 'H1'],
                     ['h2', 'H2'],
                     ['h3', 'H3'],
                 ],
                 'defaultValue' => 'auto',
                 'width' => 300,
             ],
         ]];
    }
}
