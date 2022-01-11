<?php
declare(strict_types=1);

namespace Kpim\Integration\Api;

use Kpim\Integration\Api\Data\ProductInformationInterface;

interface NotifyAboutProductUpdateServiceInterface
{
    /**
     * @param ProductInformationInterface $productInformation
     */
    public function execute(ProductInformationInterface $productInformation): void;
}
