<?php
declare(strict_types=1);

namespace JanWieland\PimAreaBricks\Controller;

use Pimcore\Controller\UserAwareController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $language = in_array($language, self::SUPPORTED_LANGUAGES) ? $language : 'en';

        return $this->render('doc/documentation.html.twig', [
            'language' => $language,
        ]);
    }
}
