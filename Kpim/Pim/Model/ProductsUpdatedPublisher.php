<?php
declare(strict_types=1);

namespace Kpim\Pim\Model;

use Magento\Framework\MessageQueue\PublisherInterface;

class ProductsUpdatedPublisher implements \Kpim\Pim\Api\ProductsUpdatedPublisherInterface
{
    /**
     * @var PublisherInterface
     */
    private $publisher;

    public function __construct(PublisherInterface $publisher)
    {
        $this->publisher = $publisher;
    }

    public function execute(array $list): void
    {
        $this->publisher->publish(self::TOPIC_NAME, $list);
    }
}
