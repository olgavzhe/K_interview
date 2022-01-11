<?php
declare(strict_types=1);

namespace Kpim\Pim\Api;

interface ProductsUpdatedPublisherInterface
{
    const TOPIC_NAME = 'k.products.updated';

    public function execute(array $list): void;
}
