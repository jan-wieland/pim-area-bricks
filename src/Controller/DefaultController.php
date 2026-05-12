<?php
namespace JanWieland\PimAreaBricks\Controller;

use Pimcore\Controller\FrontendController;
use JanWieland\PimAreaBricks\Service\TemplateService;
use Pimcore\Bundle\AdminBundle\Controller\Admin\LoginController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends FrontendController
{
    public function defaultAction(Request $request): Response
    {
        $viewParams = TemplateService::getViewParams($this->document);

        return $this->render('default/default.html.twig', $viewParams);
    }

    /**
     * Forwards the request to admin login
     */
    public function loginAction(): Response
    {
        return $this->forward(LoginController::class . '::loginCheckAction');
    }
}
