<?php
namespace JanWieland\PimAreaBricks;

use Pimcore\Extension\Bundle\Installer\SettingsStoreAwareInstaller;
use Pimcore\Model\Property\Predefined;
use Pimcore\Model\Document\DocType;

class Installer extends SettingsStoreAwareInstaller
{
    private array $propertyKeys = [
        'jwPimAreas_noIndex',
        'jwPimAreas_noFollow',
        'jwPimAreas_themeColor',
        'jwPimAreas_customTheme',
        'jwPimAreas_jsKey',
        'jwPimAreas_cssKey',
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
                'name'        => 'jwPimAreas.predefinedProperties.noIndex.name',
                'key'         => 'jwPimAreas_noIndex',
                'type'        => 'bool',
                'description' => 'jwPimAreas.predefinedProperties.noIndex.description',
                'inheritable' => true,
                'ctype'       => 'document',
            ],
            [
                'name'        => 'jwPimAreas.predefinedProperties.noFollow.name',
                'key'         => 'jwPimAreas_noFollow',
                'type'        => 'bool',
                'description' => 'jwPimAreas.predefinedProperties.noFollow.description',
                'inheritable' => true,
                'ctype'       => 'document',
            ],
            [
                'name'        => 'jwPimAreas.predefinedProperties.themeColor.name',
                'key'         => 'jwPimAreas_themeColor',
                'type'        => 'text',
                'description' => 'jwPimAreas.predefinedProperties.themeColor.description',
                'inheritable' => true,
                'ctype'       => 'document',
            ],
            [
                'name'        => 'jwPimAreas.predefinedProperties.customTheme.name',
                'key'         => 'jwPimAreas_customTheme',
                'type'        => 'text',
                'description' => 'jwPimAreas.predefinedProperties.customTheme.description',
                'inheritable' => true,
                'ctype'       => 'document',
            ],
            [
                'name'        => 'jwPimAreas.predefinedProperties.jsKey.name',
                'key'         => 'jwPimAreas_jsKey',
                'type'        => 'text',
                'description' => 'jwPimAreas.predefinedProperties.jsKey.description',
                'inheritable' => true,
                'ctype'       => 'document',
            ],
            [
                'name'        => 'jwPimAreas.predefinedProperties.cssKey.name',
                'key'         => 'jwPimAreas_cssKey',
                'type'        => 'text',
                'description' => 'jwPimAreas.predefinedProperties.cssKey.description',
                'inheritable' => true,
                'ctype'       => 'document',
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
        foreach ($this->propertyKeys as $key) {
            $property = Predefined::getByKey($key);
            if ($property instanceof Predefined) {
                $property->delete();
            }
        }
    }

    private function createDocumentTypes(): void
    {
        $docType = new DocType();
        $docType->setName('JWpimAreas Default Page');
        $docType->setController('JanWieland\PimAreaBricks\Controller\DefaultController::defaultAction');
        $docType->setType('page');
        $docType->setGroup('JWpimAreas');
        $docType->save();
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
