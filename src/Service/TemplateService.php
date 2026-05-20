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
            'jwPimAreas' => [
                # Data from page properties:
                'navMain' => self::getNavMain($document),
                'hideNavs' => (bool) ($document?->getProperty('jwPimAreas.hideNavs') ?? false),
                'noIndexAll' => (bool) $document?->getProperty('jwPimAreas.noIndexAll') ?? false,
                'noIndex' => (bool) $document?->getProperty('jwPimAreas.noIndex') ?? false,
                'noFollow' => (bool) $document?->getProperty('jwPimAreas.noFollow') ?? false,
                'themeColor' => (string) $document?->getProperty('jwPimAreas.themeColor') ?? '#000',
                'customTheme' => (string) $document?->getProperty('jwPimAreas.customTheme'),
                'customThemeBundle' => (string) $document?->getProperty('jwPimAreas.customTheme.bundle') ?? '_default',
                'fontFamilySans' => (string) $document?->getProperty('jwPimAreas.fontFamilySans') ?? 'Merriweather Sans',
                'fontFamilySerif' => (string) $document?->getProperty('jwPimAreas.fontFamilySerif') ?? 'Merriweather',
                'bodyFontFamily' => (string) $document?->getProperty('jwPimAreas.bodyFontFamily') ?? 'font-sans',
                'bodyFontWeight' => (string) $document?->getProperty('jwPimAreas.bodyFontWeight') ?? 'font-light',
                'bodyAntialiased' => (bool) $document?->getProperty('jwPimAreas.bodyFontWeight') ?? true,
                'jsKey' => (string) $document?->getProperty('jwPimAreas.jsKey'),
                'jsKeyBundle' => (string) $document?->getProperty('jwPimAreas.jsKey.bundle') ?? '_default',
                'cssKey' => (string) $document?->getProperty('jwPimAreas.cssKey'),
                'cssKeyBundle' => (string) $document?->getProperty('jwPimAreas.cssKey.bundle') ?? '_default',
                'headFootInPim' => (bool) ($document?->getProperty('jwPimAreas.headFootInPim') ?? false),
                # Generated data:
                'isRootPage' => $document?->getId() !== null
                    && $document->getProperty('jwPimAreas.rootNav')?->getId() !== null
                    && $document->getId() === $document->getProperty('jwPimAreas.rootNav')->getId(),
            ],
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
