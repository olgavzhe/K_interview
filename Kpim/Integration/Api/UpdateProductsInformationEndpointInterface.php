<?php
declare(strict_types=1);

namespace Kpim\Integration\Api;

use Kpim\Integration\Api\Data\ProductInformationInterface;

/**
 * Interface UpdateProductsInformationEndpointInterface
 * @package Kpim\Integration\Api
 */
interface UpdateProductsInformationEndpointInterface
{
    public function execute($productsInformation);
}
