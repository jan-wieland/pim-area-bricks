<?php
namespace JanWieland\PimAreaBricks\Service;

use Pimcore\Model\Document;
use Pimcore\Model\Document\Link;

class TemplateService
{
    /**
     * @param Document $document
     * @return array
     */
    public static function getViewParams(Document $document): array
    {
        return [
            'jwPimAreas_navMain' => self::getNavMain($document),
            'jwPimAreas_themeColor' => $document?->getProperty('jwPimAreas.themeColor') ?? '#000',
        ];
    }

    /**
     * @param Document $document
     * @return array
     */
    private static function getNavMain(Document $document): array
    {
        $rootNav = $document->getProperty('jwPimAreas.rootNav');
        if (!$rootNav instanceof Document) {
            return [];
        }
        $items = [];
        foreach ($rootNav->getChildren() as $item) {
            if (!$item->isPublished()) {
                continue;
            }
            if (!in_array($item->getType(), ['page', 'link'])) {
                continue;
            }
            if ($item->getProperty('navigation_exclude')) {
                continue;
            }
            $subItems = [];
            foreach ($item->getChildren() as $subItem) {
                if (!$subItem->isPublished()) {
                    continue;
                }
                if (!in_array($subItem->getType(), ['page', 'link'])) {
                    continue;
                }
                if ($subItem->getProperty('navigation_exclude')) {
                    continue;
                }
                $subItems[$subItem->getId()] = [
                    'title' => $subItem->getProperty('navigation_name') ?: $subItem->getTitle(),
                    'url' => $subItem instanceof Link ? $subItem->getHref() : ($subItem->getPrettyUrl() ?: $subItem->getFullPath()),
                ];
            }
            $items[$item->getId()] = [
                'title' => $item->getProperty('navigation_name') ?: $item->getTitle(),
                'url' => $item instanceof Link ? $item->getHref() : ($item->getPrettyUrl() ?: $item->getFullPath()),
                'children' => $subItems,
            ];
        }
        return $items;
    }
}
