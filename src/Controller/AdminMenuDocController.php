<?php

declare(strict_types=1);

namespace JanWieland\PimAreaBricks\Controller;

use Pimcore\Controller\UserAwareController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Yaml\Yaml;

class AdminMenuDocController extends UserAwareController
{
    private const SUPPORTED_LANGUAGES = ['de', 'en'];

    /**
     * @param Request $request
     * @return Response
     */
    #[Route('/admin/jwAreaBricks/docs', name: 'jw_area_bricks_docs')]
    public function adminMenuDocAction(Request $request): Response
    {
        $language = $this->getPimcoreUser()?->getLanguage() ?? 'en';
        $language = in_array($language, self::SUPPORTED_LANGUAGES, true) ? $language : 'en';
        $translations = [];

        try {
            $translations = Yaml::parseFile(
                sprintf(
                    '%s/docs/translations/%s.yaml',
                    \Pimcore::getKernel()->getBundle('PimAreaBricksBundle')->getPath(),
                    $language
                )
            );
        } catch (\Exception $e) {}

        return $this->render('docs/documentation.html.twig', [
            'language' => $language,
            'trans' => $translations,
        ]);
    }
}
