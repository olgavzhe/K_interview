<?php
declare(strict_types=1);

namespace Ksa\Update\Model;

use Kpim\Integration\Api\Data\ProductInformationInterface;
use Magento\Framework\MessageQueue\PublisherInterface;

class SystemAProductUpdatePublisher implements \Ksa\Update\Api\SystemAProductUpdatePublisherInterface
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
