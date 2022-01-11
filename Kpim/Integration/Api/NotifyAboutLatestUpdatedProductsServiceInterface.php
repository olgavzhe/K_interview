<?php
declare(strict_types=1);

namespace Kpim\Integration\Api;

interface NotifyAboutLatestUpdatedProductsServiceInterface
{
    /**
     * @param array $productIds
     */
    public function execute(array $productIds): void;
}
