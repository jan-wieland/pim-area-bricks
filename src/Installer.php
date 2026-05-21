<?php
namespace JanWieland\PimAreaBricks;

use Pimcore\Extension\Bundle\Installer\SettingsStoreAwareInstaller;
use Pimcore\Model\Property\Predefined;
use Pimcore\Model\Property\Predefined\Listing as PredefinedListing;
use Pimcore\Model\Document\DocType;

class Installer extends SettingsStoreAwareInstaller
{
    private array $propertyKeys = [
        'jwPimAreas.navMainRoot',
        'jwPimAreas.hideNavs',
        'jwPimAreas.noIndexAll',
        'jwPimAreas.noIndex',
        'jwPimAreas.noFollow',
        'jwPimAreas.themeColor',
        'jwPimAreas.customTheme',
        'jwPimAreas.customThemeBundle',
        'jwPimAreas.customThemeDirectory',
        'jwPimAreas.fontFamilySans',
        'jwPimAreas.fontFamilySerif',
        'jwPimAreas.bodyFontFamily',
        'jwPimAreas.bodyFontWeight',
        'jwPimAreas.bodyAntialiased',
        'jwPimAreas.jsKey',
        'jwPimAreas.jsKeyBundle',
        'jwPimAreas.cssKey',
        'jwPimAreas.cssKeyBundle',
        'jwPimAreas.headFootInPim',
    ];

    private array $docTypes = [
        [
            'name' => 'Content Page',
            'controller' => 'JanWieland\PimAreaBricks\Controller\DefaultController::defaultAction',
            'type' => 'page',
        ],
    ];

    public function install(): void
    {
        $this->createPredefinedProperties();
        $this->createDocumentTypes();
        parent::install();
    }

    public function uninstall(): void
    {
        $this->removePredefinedProperties();
        $this->removeDocumentTypes();
        parent::uninstall();
    }

    private function createPredefinedProperties(): void
    {
        $properties = [
            [
                'name' => 'jwPimAreas.predefinedProperties.navMainRoot.name',
                'key' => 'jwPimAreas.navMainRoot',
                'type' => 'document',
                'description' => 'jwPimAreas.predefinedProperties.navMainRoot.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.hideNavs.name',
                'key' => 'jwPimAreas.hideNavs',
                'type' => 'bool',
                'description' => 'jwPimAreas.predefinedProperties.hideNavs.description',
                'inheritable' => false,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.noIndexAll.name',
                'key' => 'jwPimAreas.noIndexAll',
                'type' => 'bool',
                'description' => 'jwPimAreas.predefinedProperties.noIndexAll.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.noIndex.name',
                'key' => 'jwPimAreas.noIndex',
                'type' => 'bool',
                'description' => 'jwPimAreas.predefinedProperties.noIndex.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.noFollow.name',
                'key' => 'jwPimAreas.noFollow',
                'type' => 'bool',
                'description' => 'jwPimAreas.predefinedProperties.noFollow.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.themeColor.name',
                'key' => 'jwPimAreas.themeColor',
                'type' => 'text',
                'description' => 'jwPimAreas.predefinedProperties.themeColor.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.customTheme.name',
                'key' => 'jwPimAreas.customTheme',
                'type' => 'text',
                'description' => 'jwPimAreas.predefinedProperties.customTheme.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.customThemeBundle.name',
                'key' => 'jwPimAreas.customThemeBundle',
                'type' => 'text',
                'description' => 'jwPimAreas.predefinedProperties.customThemeBundle.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.customThemeDirectory.name',
                'key' => 'jwPimAreas.customThemeDirectory',
                'type' => 'document',
                'description' => 'jwPimAreas.predefinedProperties.customThemeDirectory.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.fontFamilySans.name',
                'key' => 'jwPimAreas.fontFamilySans',
                'type' => 'text',
                'description' => 'jwPimAreas.predefinedProperties.fontFamilySans.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.fontFamilySerif.name',
                'key' => 'jwPimAreas.fontFamilySerif',
                'type' => 'text',
                'description' => 'jwPimAreas.predefinedProperties.fontFamilySerif.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.bodyFontFamily.name',
                'key' => 'jwPimAreas.bodyFontFamily',
                'type' => 'text',
                'description' => 'jwPimAreas.predefinedProperties.bodyFontFamily.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.bodyFontWeight.name',
                'key' => 'jwPimAreas.bodyFontWeight',
                'type' => 'text',
                'description' => 'jwPimAreas.predefinedProperties.bodyFontWeight.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.bodyAntialiased.name',
                'key' => 'jwPimAreas.bodyAntialiased',
                'type' => 'bool',
                'description' => 'jwPimAreas.predefinedProperties.bodyAntialiased.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.jsKey.name',
                'key' => 'jwPimAreas.jsKey',
                'type' => 'text',
                'description' => 'jwPimAreas.predefinedProperties.jsKey.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.jsKeyBundle.name',
                'key' => 'jwPimAreas.jsKeyBundle',
                'type' => 'text',
                'description' => 'jwPimAreas.predefinedProperties.jsKeyBundle.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.cssKey.name',
                'key' => 'jwPimAreas.cssKey',
                'type' => 'text',
                'description' => 'jwPimAreas.predefinedProperties.cssKey.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.cssKeyBundle.name',
                'key' => 'jwPimAreas.cssKeyBundle',
                'type' => 'text',
                'description' => 'jwPimAreas.predefinedProperties.cssKeyBundle.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.headFootInPim.name',
                'key' => 'jwPimAreas.headFootInPim',
                'type' => 'bool',
                'description' => 'jwPimAreas.predefinedProperties.headFootInPim.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
        ];

        foreach ($properties as $data) {
            $property = new Predefined();
            $property->setName($data['name']);
            $property->setKey($data['key']);
            $property->setType($data['type']);
            $property->setDescription($data['description']);
            $property->setCtype($data['ctype']);
            $property->setInheritable($data['inheritable']);
            $property->save();
        }
    }

    private function removePredefinedProperties(): void
    {
        $list = new PredefinedListing();
        $list->load();
        foreach ($list->getProperties() as $property) {
            if (in_array($property->getKey(), $this->propertyKeys)) {
                $property->delete();
            }
        }
    }

    private function createDocumentTypes(): void
    {
        foreach ($this->docTypes as $data) {
            $docType = new DocType();
            $docType->setName($data['name']);
            $docType->setController($data['controller']);
            $docType->setType($data['type']);
            $docType->setGroup('JWpimAreas');
            $docType->save();
        }
    }

    private function removeDocumentTypes(): void
    {
        $list = new DocType\Listing();
        $list->load();
        foreach ($list->getDocTypes() as $docType) {
            if ($docType->getGroup() === 'JWpimAreas') {
                $docType->delete();
            }
        }
    }
}
