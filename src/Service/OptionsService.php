<?php

namespace JanWieland\PimAreaBricks\Service;

use Pimcore\Http\Request\Resolver\EditmodeResolver;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Editable\Area\Info;

class OptionsService
{
    private EditmodeResolver $editmodeResolver;
    private array $editables = [];
    private bool $isEditMode;

    public function __construct(EditmodeResolver $editmodeResolver)
    {
        $this->editmodeResolver = $editmodeResolver;
    }

    /**
     * @param Info $info
     * @return object
     */
    public function getOptionsByInfo(Info $info): object
    {
        $this->isEditMode = $this->editmodeResolver->isEditmode();
        dump($info->getDocument->getProperty('editorLanguage'));
        $result = (object)[];

        # Get all editables from the calling area:
        $areaKey = ((array)$info->getEditable())["\0*\0currentIndex"]['key'];
        $areaPrefix = sprintf('%s:%s.', $info->getEditable()->getName(), $areaKey);
        $this->editables = array_filter(
            $info->getDocument()->getEditables(),
            static fn(string $key): bool => str_starts_with($key, $areaPrefix),
            ARRAY_FILTER_USE_KEY
        );

        # Extract data for different topics, if available:
        $this->getParamsHeadline($info, $result);
        $this->getParamsLayout($info, $result);

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
