<?php
namespace JanWieland\PimAreaBricks\Controller;

use Pimcore\Controller\FrontendController;
use JanWieland\PimAreaBricks\Service\TemplateService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends FrontendController
{
    public function defaultAction(Request $request): Response
    {
        $viewParams = TemplateService::getViewParams($this->document);

        return $this->render('@PimAreaBricks/default/default.html.twig', $viewParams);
    }
}
