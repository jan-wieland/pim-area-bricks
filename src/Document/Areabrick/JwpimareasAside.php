<?php
namespace JanWieland\PimAreaBricks\Document\Areabrick;

use Pimcore\Extension\Document\Areabrick\AbstractTemplateAreabrick;
use Pimcore\Model\Document\Editable\Area\Info;
use Symfony\Component\HttpFoundation\Response;
use JanWieland\PimAreaBricks\Service\BricksService;
use JanWieland\PimAreaBricks\Service\OptionsService;

class JwpimareasAside extends AbstractTemplateAreabrick
{
    public function __construct(
        private readonly OptionsService $optionsService
    ) {}

    /**
     * @return string
     */
    public function getName(): string
    {
        return BricksService::transAdmin('jwPimAreas.aside.name');
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'HTML aside';
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return '/bundles/pimareabricks/images/editmode/information-slab-box-outline.svg';
    }

    /**
     * @param Info $info
     * @return Response|null
     */
    public function action(Info $info): ?Response
    {
        $params = $this->optionsService->getOptionsByInfo($info);
        foreach ($params as $key => $value) {
            $info->setParam($key, $value);
        }

        return null;
    }

    /**
     * @return bool
     */
    public function needsReload(): bool
    {
        // optional
        // here you can decide whether adding this bricks should trigger a reload
        // in the editing interface, this could be necessary in some cases. default=false
        return false;
    }
}
