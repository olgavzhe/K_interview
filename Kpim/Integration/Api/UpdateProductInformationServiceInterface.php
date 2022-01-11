<?php
declare(strict_types=1);

namespace Kpim\Integration\Api;

use Kpim\Integration\Api\Data\ProductInformationInterface;

interface UpdateProductInformationServiceInterface
{
    /**
     * @param ProductInformationInterface $productInformation
     * @return bool
     */
    public function execute(ProductInformationInterface $productInformation): bool;
}
