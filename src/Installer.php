<?php
namespace JanWieland\PimAreaBricks;

use Pimcore\Extension\Bundle\Installer\SettingsStoreAwareInstaller;
use Pimcore\Model\Property\Predefined;
use Pimcore\Model\Property\Predefined\Listing as PredefinedListing;
use Pimcore\Model\Document\DocType;

class Installer extends SettingsStoreAwareInstaller
{
    private array $propertyKeys = [
        'jwPimAreas_navMainRoot',
        'jwPimAreas_hideNavs',
        'jwPimAreas_noIndex',
        'jwPimAreas_noFollow',
        'jwPimAreas_themeColor',
        'jwPimAreas_customTheme',
        'jwPimAreas_jsKey',
        'jwPimAreas_cssKey',
        'jwPimAreas_headFootInPim',
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
                'key' => 'jwPimAreas_navMainRoot',
                'type' => 'document',
                'description' => 'jwPimAreas.predefinedProperties.navMainRoot.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.hideNavs.name',
                'key' => 'jwPimAreas_hideNavs',
                'type' => 'bool',
                'description' => 'jwPimAreas.predefinedProperties.hideNavs.description',
                'inheritable' => false,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.noIndex.name',
                'key' => 'jwPimAreas_noIndex',
                'type' => 'bool',
                'description' => 'jwPimAreas.predefinedProperties.noIndex.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.noFollow.name',
                'key' => 'jwPimAreas_noFollow',
                'type' => 'bool',
                'description' => 'jwPimAreas.predefinedProperties.noFollow.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.themeColor.name',
                'key' => 'jwPimAreas_themeColor',
                'type' => 'text',
                'description' => 'jwPimAreas.predefinedProperties.themeColor.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.customTheme.name',
                'key' => 'jwPimAreas_customTheme',
                'type' => 'text',
                'description' => 'jwPimAreas.predefinedProperties.customTheme.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.jsKey.name',
                'key' => 'jwPimAreas_jsKey',
                'type' => 'text',
                'description' => 'jwPimAreas.predefinedProperties.jsKey.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.cssKey.name',
                'key' => 'jwPimAreas_cssKey',
                'type' => 'text',
                'description' => 'jwPimAreas.predefinedProperties.cssKey.description',
                'inheritable' => true,
                'ctype' => 'document',
            ],
            [
                'name' => 'jwPimAreas.predefinedProperties.headFootInPim.name',
                'key' => 'jwPimAreas_headFootInPim',
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
