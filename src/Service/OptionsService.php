<?php

namespace JanWieland\PimAreaBricks\Service;

use Pimcore\Http\Request\Resolver\EditmodeResolver;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Editable\Area\Info;
use Pimcore\Tool\Authentication;

class OptionsService
{
    private EditmodeResolver $editmodeResolver;

    private const SUPPORTED_LANGUAGES = ['de', 'en'];
    private string $language = 'en';

    private array $editables = [];
    private bool $isEditMode;

    public function __construct(EditmodeResolver $editmodeResolver)
    {
        $this->editmodeResolver = $editmodeResolver;
        $language = Authentication::authenticateSession()?->getLanguage() ?? 'en';
        $this->language = in_array($language, self::SUPPORTED_LANGUAGES, true) ? $language : 'en';
    }

    /**
     * @param Info $info
     * @return void
     */
    private function prepareData(Info $info): void
    {
        $this->isEditMode = $this->editmodeResolver->isEditmode();

        # Get all editables from the calling area:
        $areaKey = ((array)$info->getEditable())["\0*\0currentIndex"]['key'];
        $areaPrefix = sprintf('%s:%s.', $info->getEditable()->getName(), $areaKey);
        dump($areaPrefix);
        $this->editables = array_filter(
            $info->getDocument()->getEditables(),
            static fn(string $key): bool => str_starts_with($key, $areaPrefix),
            ARRAY_FILTER_USE_KEY
        );
    }

    /**
     * @param Info $info
     * @return object
     */
    public function getOptionsByInfo(Info $info): object
    {
        dump($info->getEditable());
        $this->prepareData($info);
        $result = (object)[
            'editorLanguage' => $this->language,
        ];

        # Extract data for different topics, if available:
        $this->getParamsHeadline($info, $result);
        $this->getParamsImages($info, $result);
        $this->getParamsLayout($info, $result);

        return $result;
    }

    /**
     * @param Info $info
     * @return object
     */
    public function getOptionsImage(Info $info): object
    {
        dump($info->getEditable());
        /*$this->prepareData($info);
        $result = (object)[
            'editorLanguage' => $this->language,
        ];

        if ($this->hasEditables(['imageAlt', 'imageCaption'])) {
            dump($info);
        }
        */
        $result = (object)[
            'editorLanguage' => $this->language,
        ];

        return $result;
    }

    /**
     * @param Info $info
     * @param object $result
     * @return void
     */
    private function getParamsHeadline(Info $info, object &$result): void
    {
        if ($this->hasEditables(['headlineSize', 'headlineStyle', 'headlineSubSize'])) {
            $hSize = $this->getEditable('headlineSize')?->getData() ?: 'h2';
            $style = $this->getEditable('headlineStyle')?->getData() ?: 'auto';
            $subStyle = $this->getEditable('headlineSubSize')?->getData() ?: 'auto';

            $result->headlineData = [
                'hSize' => $hSize,
                'hSubSize' => 'h' . ((int)(substr($hSize, 1) + 1)),
                'hKey' => $style === 'auto' ? $hSize : $style,
                'hClass' => sprintf(
                    'class="%s%s"',
                    ($style === 'auto' ? $hSize : $style),
                    ($this->isEditMode ? ' m-0' : ''),
                ),
                'subClass' => sprintf(
                    'class="%s%s%s"',
                    $subStyle === 'auto' ? 'h' . (int)substr($hSize, 1) + 1 : $subStyle,
                    ' jwpimareas-h-sub-mt',
                    ($this->isEditMode ? ' m-0' : ''),
                ),
            ];
        }
    }

    /**
     * @param Info $info
     * @param object $result
     * @return void
     */
    private function getParamsImages(Info $info, object &$result): void
    {
        if ($this->hasEditables(['imageGeneralhWidth', 'imagePos', 'imagePosRelativeH', 'imageProportion'])) {
            $generalhWidth = $this->getEditable('imageGeneralhWidth')?->getData();
            $generalhWidth = empty($generalhWidth)||$generalhWidth === '0' ? '' : sprintf('%spx', $generalhWidth);

            $imageProportion = $this->getEditable('imageProportion')?->getData() ?: '16-9';
            $imagesWidth = null;
            $imagesHeight = null;

            if (!empty($generalhWidth) && $generalhWidth !== '0') {
                $imagesWidth = (int) $generalhWidth;
                if (str_contains($imageProportion, '-')) {
                    $proportion = explode('-', $imageProportion);
                    $imagesHeight = (int) round($imagesWidth / (int) $proportion[0] * (int) $proportion[1]);
                } else {
                    $imagesHeight = $imageProportion === 'none' ? null : $imagesWidth;
                }
            }

            $result->imagesData = [
                'generalhWidth' => $generalhWidth,
                'imagePos' => $this->getEditable('imagePos')?->getData() ?: 'top-center',
                'imagePosRelativeH' => $this->getEditable('imagePosRelativeH')?->getData() ?: 'introduction',
                'imageProportion' => $this->getEditable('imageProportion')?->getData() ?: '16-9',
                'imagesWidth' => $imagesWidth,
                'imagesHeight' => $imagesHeight,
            ];
        }

        if ($this->hasEditables(['imagesAsSlider', 'sliderFromBreakpoint', 'sliderImages', 'sliderImagesScroll'])) {
        }
    }

    /**
     * @param Info $info
     * @param object $result
     * @return void
     */
    private function getParamsLayout(Info $info, object &$result): void
    {
        if ($this->hasEditables(['gridColumns', 'girdBreakpoints', 'endsGridRow', 'gridItemVertical', 'boxStyle'])) {
        }
        if ($this->hasEditables(['spaceBefore', 'spaceAfter'])) {
        }
    }

    /**
     * Checks whether all given editable keys exist in the current area context.
     *
     * @param array $keys
     * @return bool
     */
    private function hasEditables(array $keys): bool
    {
        foreach ($keys as $key) {
            if ($this->getEditable($key) === null) {
                return false;
            }
        }

        return true;
    }

    /**
     * Looks up an editable by its short key (without area prefix) from $this->editables.
     *
     * @param string $key
     * @return Document\Editable|null
     */
    private function getEditable(string $key): ?Document\Editable
    {
        $matches = array_filter(
            $this->editables,
            static fn(string $k): bool => str_ends_with($k, '.' . $key),
            ARRAY_FILTER_USE_KEY
        );

        return array_values($matches)[0] ?? null;
     }
}
