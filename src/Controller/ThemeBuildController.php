<?php
declare(strict_types=1);

namespace JanWieland\PimAreaBricks\Controller;

use Pimcore\Controller\UserAwareController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Pimcore\Model\Asset\Folder;
use Pimcore\Model\Tool\SettingsStore;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Contracts\Service\Attribute\Required;

class ThemeBuildController extends UserAwareController
{
    private object $result;
    private object $theme;
    private string $language;

    private const SUPPORTED_LANGUAGES = ['de', 'en'];

    private TranslatorInterface $translator;

    #[Required]
    public function setTranslator(TranslatorInterface $translator): void
    {
        $this->translator = $translator;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/admin/jwAreaBricks/run-theme-import', name: 'jw_area_bricks_run_theme_import', methods: ['POST'])]
    public function runThemeImportAction(Request $request): JsonResponse
    {
        $language = (string) $request->request->get('language');
        $this->language = in_array($language, self::SUPPORTED_LANGUAGES) ? $language : 'en';

        $this->result = (object) [
            'success' => false,
            'message' => $this->getMessage('jwPimAreas.contextMenuTheme.result.forbidden'),
        ];

        if (!$this->getPimcoreUser()) {
            return new JsonResponse($this->result);
        }

        $assetFolderId = (int) $request->request->get('assetFolderId');
        $assetFolder = Folder::getById($assetFolderId);

        if (!$assetFolder instanceof Folder) {
            $this->result->message = $this->getMessage('jwPimAreas.contextMenuTheme.result.invalidFolder');
            return new JsonResponse($this->result);
        }

        $this->theme = (object) [
            'name' => hash('crc32', (string) $assetFolderId),
            'root' => [],
        ];

        $this->buildTheme($assetFolder);
        return new JsonResponse($this->result);
    }

    /**
     * @param Folder $assetFolder
     * @return void
     */
    private function buildTheme(Folder $assetFolder): void
    {
        $listing = new \Pimcore\Model\Asset\Listing();
        $listing->setCondition(
            "path LIKE ?",
            [$assetFolder->getFullPath() . '/%']
        );
        $properties = (object)[];

        foreach ($listing as $asset) {
            if (pathinfo($asset->getFilename(), PATHINFO_EXTENSION) !== 'properties') {
                continue;
            }

            $parsed = parse_ini_string($asset->getData() ?? '');

            if ($parsed === false || empty($parsed)) {
                continue;
            }

            $properties = (object) $parsed;
        }

        foreach ($properties as $key => $value) {
            $this->theme->root[$key] = $value;
        }

        try {
            SettingsStore::set(
                $this->theme->name,
                json_encode($this->theme->root),
                'string',
                'jwPimAreas.themes'
            );
            $this->result->success = true;
            $this->result->message = $this->getMessage('jwPimAreas.contextMenuTheme.result.success');
        } catch (\Exception $e) {
            $this->result->message = sprintf(
                '%s: %s',
                $this->getMessage('jwPimAreas.contextMenuTheme.result.error'),
                $e->getMessage()
            );
        }
    }

    /**
     * @param string $adminTransKey
     * @return string
     */
    private function getMessage(string $adminTransKey): string
    {
        return $this->translator->trans(
            $adminTransKey,
            [],
            'admin',
            $this->language
        );
    }
}
