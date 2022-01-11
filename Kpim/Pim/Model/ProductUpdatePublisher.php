<?php
declare(strict_types=1);

namespace Kpim\Pim\Model;

use Kpim\Integration\Api\Data\ProductInformationInterface;
use Magento\Framework\MessageQueue\PublisherInterface;

class ProductUpdatePublisher implements \Kpim\Pim\Api\ProductUpdatePublisherInterface
{
    /**
     * @var PublisherInterface
     */
    private $publisher;

    public function __construct(PublisherInterface $publisher)
    {
        $this->publisher = $publisher;
    }

    public function execute(ProductInformationInterface $productInformation): void
    {
        $this->publisher->publish(self::TOPIC_NAME, $productInformation);
    }
}
