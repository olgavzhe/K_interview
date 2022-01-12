<?php
declare(strict_types=1);

namespace Kpim\Pim\Model\Queue;

use Kpim\Integration\Api\Data\ProductInformationInterface;
use Kpim\Integration\Api\UpdateProductInformationServiceInterface;
use Kpim\Integration\Api\NotifyAboutProductUpdateServiceInterface;

class HandleProductUpdateQueue
{

    /**
     * @var UpdateProductInformationServiceInterface
     */
    private $updateProductInformationService;

    /**
     * @var NotifyAboutProductUpdateServiceInterface
     */
    private $notifyAboutProductUpdateService;

    public function __construct(
        UpdateProductInformationServiceInterface $updateProductInformationService,
        NotifyAboutProductUpdateServiceInterface $notifyAboutProductUpdateService
    )
    {
        $this->updateProductInformationService = $updateProductInformationService;
        $this->notifyAboutProductUpdateService = $notifyAboutProductUpdateService;
    }

    public function process(ProductInformationInterface $productInformation): void
    {
        $result = $this->updateProductInformationService->execute($productInformation);

        /**
         * Handle the situation according to the save result if needed
         */

        $this->notifyAboutProductUpdateService->execute($productInformation);
    }
}
