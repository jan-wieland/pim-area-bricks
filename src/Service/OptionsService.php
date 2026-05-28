<?php
namespace JanWieland\PimAreaBricks\Service;

use Pimcore\Http\Request\Resolver\EditmodeResolver;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Editable\Area\Info;
class OptionsService
{
    private EditmodeResolver $editmodeResolver;
    private Document\PageSnippet $document;
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
        $this->document = $info->getDocument();
        $this->isEditMode = $this->editmodeResolver->isEditmode();
        $result = (object)[];

        $this->getParamsHeadline($info, $result);

        return $result;
    }

    /**
     * @param Info $info
     * @param object $result
     * @return void
     */
    private function getParamsHeadline(Info $info, object &$result): void
    {
        if ($this->hasEditables($info, ['headlineSize', 'headlineStyle', 'headlineSubSize'])) {
            $hSize = $this->document->getEditable('headlineSize')?->getData() ?: 'h2';
            $style = $this->document->getEditable('headlineStyle')?->getData() ?: 'auto';
            $subStyle = $this->document->getEditable('headlineSubSize')?->getData() ?: 'auto';

            $result->headlineData = [
                'hSize' => $hSize,
                'hSubSize' => 'h' . ((int)(substr($hSize, 1) + 1)),
                'hClass' => $style !== 'auto' || $this->isEditMode ?
                    sprintf(
                        ' class="%s%s"',
                        ($style !== 'auto' ? '' : $style),
                        ($this->isEditMode ? ' m-0' : '')
                    ) : '',
                'subClass' => $style !== 'auto' ?
                    sprintf(
                        ' class="%s"',
                        $subStyle === 'auto' ? 'h' . (int)substr($hSize, 1) + 1 : $subStyle,
                    ) : '',
            ];
        }
    }

    /**
     * Checks whether all given editable keys exist in the current area context.
     * @param Info $info
     * @param array $keys
     * @return bool
     */
    private function hasEditables(Info $info, array $keys): bool
    {
        $areaKey = ((array)$info->getEditable())["\0*\0currentIndex"]['key'];

        $prefix = $info->getEditable()->getName() . ':' . $areaKey;
        $editables = $info->getDocument()->getEditables();
        foreach ($keys as $key) {
            if (!array_key_exists(sprintf('%s.%s', $prefix, $key), $editables)) {
                return false;
            }
        }

        return true;
    }
}
