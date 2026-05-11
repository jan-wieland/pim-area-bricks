<?php
namespace App\Service;

class BricksService
{
    /**
     * @param string $transKey
     * @return string
     */
    public static function transAdmin(string $transKey): string
    {
        return \Pimcore::getContainer()
            ->get("translator")
            ->trans($transKey, [], "admin");
    }

    /**
     * @param bool $short
     * @return array
     */
    public static function tabLayout(bool $short = false): array
    {
        return [
            [
                "type" => "panel",
                "title" => self::transAdmin("jwPimAreabrick.groups.layout"),
                "items" => array_merge(
                    $short
                        ? []
                        : [
                            [
                                "type" => "select",
                                "name" => "gridColumns",
                                "label" => self::transAdmin(
                                    "jwPimAreabrick.groups.prams.gridColumns.label",
                                ),
                                "config" => [
                                    "store" => [
                                        [
                                            "none",
                                            self::transAdmin(
                                                "jwPimAreabrick.groups.prams.gridColumns.options.none",
                                            ),
                                        ],
                                        [
                                            "2",
                                            self::transAdmin(
                                                "jwPimAreabrick.groups.prams.gridColumns.options.2",
                                            ),
                                        ],
                                        [
                                            "3",
                                            self::transAdmin(
                                                "jwPimAreabrick.groups.prams.gridColumns.options.3",
                                            ),
                                        ],
                                        [
                                            "4",
                                            self::transAdmin(
                                                "jwPimAreabrick.groups.prams.gridColumns.options.4",
                                            ),
                                        ],
                                        [
                                            "5",
                                            self::transAdmin(
                                                "jwPimAreabrick.groups.prams.gridColumns.options.5",
                                            ),
                                        ],
                                        [
                                            "auto",
                                            self::transAdmin(
                                                "jwPimAreabrick.groups.prams.gridColumns.options.auto",
                                            ),
                                        ],
                                    ],
                                    "defaultValue" => "none",
                                ],
                            ],
                            [
                                "type" => "select",
                                "name" => "gridItemVertical",
                                "label" => self::transAdmin(
                                    "jwPimAreabrick.groups.prams.gridItemVertical.label",
                                ),
                                "config" => [
                                    "store" => [
                                        [
                                            "none",
                                            self::transAdmin(
                                                "jwPimAreabrick.groups.prams.gridItemVertical.options.none",
                                            ),
                                        ],
                                        [
                                            "top",
                                            self::transAdmin(
                                                "jwPimAreabrick.groups.prams.gridItemVertical.options.top",
                                            ),
                                        ],
                                        [
                                            "bottom",
                                            self::transAdmin(
                                                "jwPimAreabrick.groups.prams.gridItemVertical.options.bottom",
                                            ),
                                        ],
                                    ],
                                    "defaultValue" => "none",
                                ],
                            ],
                            [
                                "type" => "select",
                                "name" => "boxStyle",
                                "label" => self::transAdmin(
                                    "jwPimAreabrick.groups.prams.boxStyle.label",
                                ),
                                "config" => [
                                    "store" => [
                                        [
                                            "none",
                                            self::transAdmin(
                                                "jwPimAreabrick.groups.prams.boxStyle.options.none",
                                            ),
                                        ],
                                        [
                                            "default",
                                            self::transAdmin(
                                                "jwPimAreabrick.groups.prams.boxStyle.options.default",
                                            ),
                                        ],
                                        [
                                            "image-left",
                                            self::transAdmin(
                                                "jwPimAreabrick.groups.prams.boxStyle.options.image-left",
                                            ),
                                        ],
                                        [
                                            "image-right",
                                            self::transAdmin(
                                                "jwPimAreabrick.groups.prams.boxStyle.options.image-right",
                                            ),
                                        ],
                                        [
                                            "tile",
                                            self::transAdmin(
                                                "jwPimAreabrick.groups.prams.boxStyle.options.tile",
                                            ),
                                        ],
                                        [
                                            "rotating-tile",
                                            self::transAdmin(
                                                "jwPimAreabrick.groups.prams.boxStyle.options.rotating-tile",
                                            ),
                                        ],
                                    ],
                                    "defaultValue" => "none",
                                    "width" => 300,
                                ],
                            ],
                        ],
                    [
                        [
                            "type" => "select",
                            "name" => "spaceBefore",
                            "label" => self::transAdmin(
                                "jwPimAreabrick.groups.prams.space.before",
                            ),
                            "config" => [
                                "store" => [
                                    [
                                        "none",
                                        self::transAdmin(
                                            "jwPimAreabrick.groups.prams.space.options.none",
                                        ),
                                    ],
                                    [
                                        "extra-small",
                                        self::transAdmin(
                                            "jwPimAreabrick.groups.prams.space.options.extra-small",
                                        ),
                                    ],
                                    [
                                        "small",
                                        self::transAdmin(
                                            "jwPimAreabrick.groups.prams.space.options.small",
                                        ),
                                    ],
                                    [
                                        "medium",
                                        self::transAdmin(
                                            "jwPimAreabrick.groups.prams.space.options.medium",
                                        ),
                                    ],
                                    [
                                        "large",
                                        self::transAdmin(
                                            "jwPimAreabrick.groups.prams.space.options.large",
                                        ),
                                    ],
                                    [
                                        "extra-large",
                                        self::transAdmin(
                                            "jwPimAreabrick.groups.prams.space.options.extra-large",
                                        ),
                                    ],
                                ],
                                "defaultValue" => "none",
                            ],
                        ],
                        [
                            "type" => "select",
                            "name" => "spaceAfter",
                            "label" => self::transAdmin(
                                "jwPimAreabrick.groups.prams.space.after",
                            ),
                            "config" => [
                                "store" => [
                                    [
                                        "none",
                                        self::transAdmin(
                                            "jwPimAreabrick.groups.prams.space.options.none",
                                        ),
                                    ],
                                    [
                                        "extra-small",
                                        self::transAdmin(
                                            "jwPimAreabrick.groups.prams.space.options.extra-small",
                                        ),
                                    ],
                                    [
                                        "small",
                                        self::transAdmin(
                                            "jwPimAreabrick.groups.prams.space.options.small",
                                        ),
                                    ],
                                    [
                                        "medium",
                                        self::transAdmin(
                                            "jwPimAreabrick.groups.prams.space.options.medium",
                                        ),
                                    ],
                                    [
                                        "large",
                                        self::transAdmin(
                                            "jwPimAreabrick.groups.prams.space.options.large",
                                        ),
                                    ],
                                    [
                                        "extra-large",
                                        self::transAdmin(
                                            "jwPimAreabrick.groups.prams.space.options.extra-large",
                                        ),
                                    ],
                                ],
                                "defaultValue" => "none",
                            ],
                        ],
                        [
                            "type" => "input",
                            "name" => "anchor",
                            "label" => self::transAdmin(
                                "jwPimAreabrick.anchor.otional",
                            ),
                        ],
                    ],
                ),
            ],
        ];
    }

    /**
     * @return array
     */
    public static function tabImages(): array
    {
        return [
            [
                "type" => "panel",
                "title" => self::transAdmin("jwPimAreabrick.groups.images"),
                "items" => [
                    [
                        "type" => "input",
                        "name" => "imageAlt",
                        "label" => self::transAdmin(
                            "jwPimAreabrick.image.alt.label",
                        ),
                    ],
                    [
                        "type" => "input",
                        "name" => "imageCaption",
                        "label" => self::transAdmin(
                            "jwPimAreabrick.image.caption.label",
                        ),
                    ],
                    [
                        "type" => "select",
                        "name" => "imagePos",
                        "label" => self::transAdmin(
                            "jwPimAreabrick.image.pos.label",
                        ),
                        "config" => [
                            "store" => [
                                [
                                    "top-left",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.pos.options.top-left",
                                    ),
                                ],
                                [
                                    "top-center",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.pos.options.top-center",
                                    ),
                                ],
                                [
                                    "top-right",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.pos.options.top-right",
                                    ),
                                ],
                                [
                                    "bottom-left",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.pos.options.bottom-left",
                                    ),
                                ],
                                [
                                    "bottom-center",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.pos.options.bottom-center",
                                    ),
                                ],
                                [
                                    "bottom-right",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.pos.options.bottom-right",
                                    ),
                                ],
                                [
                                    "float-left",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.pos.options.float-left",
                                    ),
                                ],
                                [
                                    "float-right",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.pos.options.float-right",
                                    ),
                                ],
                            ],
                            "defaultValue" => "top-center",
                        ],
                    ],
                    [
                        "type" => "select",
                        "name" => "imagePosRelativeH",
                        "label" => self::transAdmin(
                            "jwPimAreabrick.image.imagePosRelativeH.label",
                        ),
                        "config" => [
                            "store" => [
                                [
                                    "before",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.imagePosRelativeH.options.before",
                                    ),
                                ],
                                [
                                    "after",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.imagePosRelativeH.options.after",
                                    ),
                                ],
                                [
                                    "introduction",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.imagePosRelativeH.options.introduction",
                                    ),
                                ],
                            ],
                            "defaultValue" => "introduction",
                        ],
                    ],
                    [
                        "type" => "select",
                        "name" => "imageProportion",
                        "label" => self::transAdmin(
                            "jwPimAreabrick.image.proportion.label",
                        ),
                        "config" => [
                            "store" => [
                                [
                                    "16-9",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.proportion.options.16-9",
                                    ),
                                ],
                                [
                                    "21-9",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.proportion.options.21-9",
                                    ),
                                ],
                                [
                                    "32:9",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.proportion.options.32-9",
                                    ),
                                ],
                                [
                                    "5:7",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.proportion.options.5-7",
                                    ),
                                ],
                                [
                                    "1-1",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.proportion.options.1-1",
                                    ),
                                ],
                                [
                                    "3:2",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.proportion.options.3-2",
                                    ),
                                ],
                                [
                                    "2:3",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.proportion.options.2-3",
                                    ),
                                ],
                                [
                                    "4:5",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.proportion.options.4-5",
                                    ),
                                ],
                                [
                                    "none",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.proportion.options.none",
                                    ),
                                ],
                                [
                                    "round",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.proportion.options.round",
                                    ),
                                ],
                                [
                                    "round-large",
                                    self::transAdmin(
                                        "jwPimAreabrick.image.proportion.options.round-large",
                                    ),
                                ],
                            ],
                            "defaultValue" => "introduction",
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public static function itemsImageSlideOptions(): array
    {
        return [
            [
                "type" => "checkbox",
                "name" => "imagesAsSlider",
                "label" => self::transAdmin(
                    "jwPimAreabrick.image.imagesAsSlider.label",
                ),
                "config" => [
                    "defaultValue" => false,
                ],
            ],
            [
                "type" => "select",
                "name" => "sliderToBreakpoint",
                "label" => self::transAdmin(
                    "jwPimAreabrick.image.sliderToBreakpoint.label",
                ),
                "config" => [
                    "store" => [
                        [
                            "always",
                            self::transAdmin(
                                "jwPimAreabrick.image.sliderToBreakpoint.options.always",
                            ),
                        ],
                        [
                            "sm",
                            self::transAdmin(
                                "jwPimAreabrick.image.sliderToBreakpoint.options.sm",
                            ),
                        ],
                        [
                            "md",
                            self::transAdmin(
                                "jwPimAreabrick.image.sliderToBreakpoint.options.md",
                            ),
                        ],
                        [
                            "lg",
                            self::transAdmin(
                                "jwPimAreabrick.image.sliderToBreakpoint.options.lg",
                            ),
                        ],
                        [
                            "xl",
                            self::transAdmin(
                                "jwPimAreabrick.image.sliderToBreakpoint.options.xl",
                            ),
                        ],
                    ],
                    "defaultValue" => "always",
                ],
            ],
            [
                "type" => "select",
                "name" => "sliderImages",
                "label" => self::transAdmin(
                    "jwPimAreabrick.image.sliderImages.label",
                ),
                "config" => [
                    "store" => [
                        [
                            "1",
                            self::transAdmin(
                                "jwPimAreabrick.image.sliderImages.options.1",
                            ),
                        ],
                        [
                            "2",
                            self::transAdmin(
                                "jwPimAreabrick.image.sliderImages.options.2",
                            ),
                        ],
                        [
                            "3",
                            self::transAdmin(
                                "jwPimAreabrick.image.sliderImages.options.3",
                            ),
                        ],
                        [
                            "4",
                            self::transAdmin(
                                "jwPimAreabrick.image.sliderImages.options.4",
                            ),
                        ],
                        [
                            "5",
                            self::transAdmin(
                                "jwPimAreabrick.image.sliderImages.options.5",
                            ),
                        ],
                    ],
                    "defaultValue" => "1",
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public static function itemsHeadline(): array
    {
        return [
            [
                "type" => "select",
                "name" => "headlineSize",
                "label" => self::transAdmin(
                    "jwPimAreabrick.headline.seo.label",
                ),
                "config" => [
                    "store" => [
                        ["h1", "H1"],
                        [
                            "h2",
                            self::transAdmin(
                                "jwPimAreabrick.headline.seo.options.h2",
                            ),
                        ],
                        ["h3", "H3"],
                    ],
                    "defaultValue" => "h2",
                ],
            ],
            [
                "type" => "select",
                "name" => "headlineStyle",
                "label" => self::transAdmin(
                    "jwPimAreabrick.headline.style.label",
                ),
                "config" => [
                    "store" => [
                        [
                            "auto",
                            self::transAdmin(
                                "jwPimAreabrick.headline.style.options.auto",
                            ),
                        ],
                        ["h1", "H1"],
                        ["h2", "H2"],
                        ["h3", "H3"],
                    ],
                    "defaultValue" => "auto",
                    "width" => 300,
                ],
            ],
            [
                "type" => "select",
                "name" => "headlineSubSize",
                "label" => self::transAdmin(
                    "jwPimAreabrick.headline.subSize.label",
                ),
                "config" => [
                    "store" => [
                        [
                            "auto",
                            self::transAdmin(
                                "jwPimAreabrick.headline.subSize.options.auto",
                            ),
                        ],
                        ["h1", "H1"],
                        ["h2", "H2"],
                        ["h3", "H3"],
                    ],
                    "defaultValue" => "auto",
                    "width" => 300,
                ],
            ],
        ];
    }
}
