<?php
declare(strict_types=1);

namespace Kpim\Pim\Api;

use Kpim\Integration\Api\Data\ProductInformationInterface;

interface ProductUpdatePublisherInterface
{
    const TOPIC_NAME = 'k.product.update';

    public function execute(ProductInformationInterface $productInformation): void;
}
