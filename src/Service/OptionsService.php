<?php
namespace JanWieland\PimAreaBricks\Service;

use Pimcore\Http\Request\Resolver\EditmodeResolver;
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
        $editables = $document->getEditables();
        $isEditMode = $this->editmodeResolver->isEditmode();
        $result = (object)[];

        $hasAllItems = fn(array $keys) => !array_diff($keys, array_keys($editables));

        $result->editablesList = $editables;

        #if ($hasAllItems(['headlineSize', 'headlineStyle', 'headlineSubSize'])) {
            $hSize = $document->getEditable('headlineSize')?->getData() ?: 'h2';
            $style = $document->getEditable('headlineStyle')?->getData() ?: 'auto';
            $subStyle = $document->getEditable('headlineSubSize')?->getData() ?: 'auto';

            $result->hSize = $hSize;
            $result->hSubSize = 'h' . ((int) (substr($hSize, 1) + 1));
            $result->hClass = $style !== 'auto' || $isEditMode ?
                sprintf(
                    ' class="%s%s"',
                    ($style !== 'auto' ? $style : ''),
                    (Editable::isInEditMode() ? ' m-0' : '')
                ) : '';
            $result->subClass = $style !== 'auto' ?
                sprintf(
                    ' class="%s"',
                    $subStyle === 'auto' ? 'h' . (int)substr($hSize, 1) + 1 : $subStyle,
                ) : '';
                #}

        return $result;
    }
}
