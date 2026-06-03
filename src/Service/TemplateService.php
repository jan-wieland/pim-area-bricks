<?php
namespace JanWieland\PimAreaBricks\Service;

use Pimcore\Model\Document;
use Pimcore\Model\Document\Link;
use Pimcore\Model\Asset\Folder;
use Pimcore\Model\Tool\SettingsStore;
use Pimcore\Tool\Authentication;

class TemplateService
{
    /**
     * @param Document $document
     * @return array
     */
    public static function getViewParams(Document $document): array
    {
        # Check whether the bundles are (still) present:
        $customThemeBundle  = (string) self::getPageProperty($document, 'customTheme.bundle') ?: '_default';
        $hasCustomThemeBundle  = $customThemeBundle !== '_default' && \Pimcore::getKernel()->hasBundle($customThemeBundle);
        $jsKeyBundle  = (string) self::getPageProperty($document, 'jsKey.bundle') ?: '_default';
        $hasJsKeyBundle  = $jsKeyBundle !== '_default' && \Pimcore::getKernel()->hasBundle($jsKeyBundle);
        $cssKeyBundle = (string) self::getPageProperty($document, 'cssKey.bundle') ?: '_default';
        $hasCssKeyBundle = $cssKeyBundle !== '_default' && \Pimcore::getKernel()->hasBundle($cssKeyBundle);

        $customThemeDirectory = $document?->getProperty('jwPimAreas.customThemeDirectory');
        $customThemeId = $customThemeDirectory instanceof Folder ? hash('crc32', (string) $customThemeDirectory->getId()) : null;
        $customThemeData = null;

        if (! is_null($customThemeId)) {
            $customThemeSettings = SettingsStore::get($customThemeId, 'jwPimAreas.themes');
            $customThemeData = $customThemeSettings ? json_decode($customThemeSettings->getData(), true) : null;
        }

        return [
            'jwPimAreas' => [
                # Data from page properties:
                'navMain' => self::getNavMain($document),
                'hideNavs' => (bool) (self::getPageProperty($document, 'hideNavs') ?? false),
                'noIndexAll' => (bool) (self::getPageProperty($document, 'noIndexAll') ?? false),
                'noIndex' => (bool) (self::getPageProperty($document, 'noIndex') ?? false),
                'noFollow' => (bool) (self::getPageProperty($document, 'noFollow') ?? false),
                'themeColor' => (string) self::getPageProperty($document, 'themeColor') ?: '#000',
                'customTheme' =>  $hasCustomThemeBundle ? ((string) self::getPageProperty($document, 'customTheme') ?: null) : null,
                'customThemeBundle' => $hasCustomThemeBundle ? $customThemeBundle : null,
                'customThemeId' => $customThemeId,
                'customThemeData' => $customThemeData,
                'fontFamilySans' => (string) self::getPageProperty($document, 'fontFamilySans') ?: 'Merriweather Sans',
                'fontFamilySerif' => (string) self::getPageProperty($document, 'fontFamilySerif') ?: 'Merriweather',
                'bodyFontFamily' => (string) self::getPageProperty($document, 'bodyFontFamily') ?: 'font-sans',
                'bodyFontWeight' => (string) self::getPageProperty($document, 'bodyFontWeight') ?: 'font-light',
                'bodyAntialiased' => (bool) (self::getPageProperty($document, 'bodyAntialiased') ?? true),
                'jsKey' => $hasJsKeyBundle ? ((string) self::getPageProperty($document, 'jsKey') ?: null) : null,
                'jsKeyBundle' => $hasJsKeyBundle  ? $jsKeyBundle : null,
                'cssKey' => $hasCssKeyBundle ? ((string) self::getPageProperty($document, 'cssKey') ?: null) : null,
                'cssKeyBundle' => $hasCssKeyBundle ? $cssKeyBundle : null,
                'headFootInPim' => (bool) (self::getPageProperty($document, 'headFootInPim') ?? false),
                # Generated data:
                'isRootPage' => $document?->getId() !== null
                    && self::getPageProperty($document, 'rootNav')?->getId() !== null
                    && $document->getId() === self::getPageProperty($document, 'rootNav')?->getId(),
                'pageId' => (string) ($document ? $document->getId() : '0'),
                'language' => (string) $document?->getProperty('language') ?: 'de',
            ],
        ];
    }

    /**
     * @param Document|null $document
     * @param string $key
     * @return mixed
     */
    private static function getPageProperty(?Document $document, string $pagePropertyKey): mixed
    {
        return $document?->getProperty(
            sprintf('jwPimAreas.%s', $pagePropertyKey)
        );
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
