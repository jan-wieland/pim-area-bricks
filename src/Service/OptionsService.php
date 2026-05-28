<?php
namespace JanWieland\PimAreaBricks\Service;

use Pimcore\Http\Request\Resolver\EditmodeResolver;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Editable\Area\Info;
class OptionsService
{
    private EditmodeResolver $editmodeResolver;

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
        $document = $info->getDocument();
        $isEditMode = $this->editmodeResolver->isEditmode();
        $result = (object)[];

        $this->getParamsHeadline($info, $document, $result, $isEditMode);

        dump(get_class_methods($info));
        dump($info);
        return $result;
    }

    /**
     * @param Info $info
     * @param Document $document
     * @param object $result
     * @param bool $isEditMode
     * @return void
     */
    private function getParamsHeadline(Info $info, Document $document, object &$result, bool $isEditMode): void
    {
        if ($this->hasEditables($info, ['headlineSize', 'headlineStyle', 'headlineSubSize'])) {
            $hSize = $document->getEditable('headlineSize')?->getData() ?: 'h2';
            $style = $document->getEditable('headlineStyle')?->getData() ?: 'auto';
            $subStyle = $document->getEditable('headlineSubSize')?->getData() ?: 'auto';

            $result->headlineData = [
                'hSize' => $hSize,
                'hSubSize' => 'h' . ((int)(substr($hSize, 1) + 1)),
                'hClass' => $style !== 'auto' || $isEditMode ?
                    sprintf(
                        ' class="%s%s"',
                        ($style !== 'auto' ? '' : $style),
                        ($isEditMode ? ' m-0' : '')
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
     * @param Info $info
     * @param array $keys
     * @return bool
     */
    private function hasEditables(Info $info, array $keys): bool
    {
        $prefix = $info->getParam('name');
        $editables = $info->getDocument()->getEditables();
        foreach ($keys as $key) {
            if (!array_key_exists(sprintf('%s.%s', $prefix, $key), $editables)) {
                return false;
            }
        }

        return true;
    }
}
