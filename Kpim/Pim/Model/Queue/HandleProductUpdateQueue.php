<?php
declare(strict_types=1);

namespace Kpim\Pim\Model\Queue;

use Kpim\Integration\Api\Data\ProductInformationInterface;
use Kpim\Integration\Api\UpdateProductInformationServiceInterface;

class HandleProductUpdateQueue
{

    /**
     * @var UpdateProductInformationServiceInterface
     */
    private $updateProductInformationService;

    public function __construct(
        UpdateProductInformationServiceInterface $updateProductInformationService
    )
    {
        $this->updateProductInformationService = $updateProductInformationService;
    }

    public function process(ProductInformationInterface $productInformation): void
    {
        $result = $this->updateProductInformationService->execute($productInformation);

        /**
         * Handle the situation according to the save result if needed
         */
    }
}
