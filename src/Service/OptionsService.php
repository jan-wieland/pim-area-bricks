<?php
namespace JanWieland\PimAreaBricks\Service;

use Pimcore\Model\Document\Editable\Area\Info;
use Pimcore\Model\Document\Editable;

class OptionsService
{
    /**
     * @param Info $info
     * @return object
     */
    public static function getOptionsByInfo(Info $info): object
    {
        $document = $info->getDocument();
        $editables = $document->getEditables();
        $result = (object)[];

        $hasAllItems = fn(array $keys) => !array_diff($keys, array_keys($editables));

        #if ($hasAllItems(['headlineSize', 'headlineStyle', 'headlineSubSize'])) {
            $hSize = $document->getEditable('headlineSize')?->getData() ?: 'h2';
            $style = $document->getEditable('headlineStyle')?->getData() ?: 'auto';
            $subStyle = $document->getEditable('headlineSubSize')?->getData() ?: 'auto';

            $result->hSize = $hSize;
            $result->hSubSize = 'h' . ((int) (substr($hSize, 1) + 1));
            $result->hClass = $style !== 'auto' || Editable::isInEditMode() ?
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
