<?php
declare(strict_types=1);

namespace Ksa\Update\Api;

use Kpim\Integration\Api\Data\ProductInformationInterface;

interface SystemAProductUpdatePublisherInterface
{
    const TOPIC_NAME = 'k.system.a.product.update';

    public function execute(ProductInformationInterface $productInformation): void;
}
