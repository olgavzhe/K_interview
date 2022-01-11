<?php
declare(strict_types=1);

namespace Ksa\Update\Observer;

use Kpim\Integration\Api\Data\ProductInformationInterface;
use Magento\Framework\Event\Observer;
use Ksa\Update\Service\NotifySystemAService;
use Ksa\Update\Api\SystemAProductUpdatePublisherInterface;

class ProductUpdateInformation implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var
     */
    private $systemAProductUpdatePublisher;

    public function __construct(
        SystemAProductUpdatePublisherInterface $systemAProductUpdatePublisher
    )
    {
        $this->systemAProductUpdatePublisher = $systemAProductUpdatePublisher;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        /** @var ProductInformationInterface $productInformation */
        $productInformation = $observer->getData('product');
        $this->systemAProductUpdatePublisher->execute($productInformation);
    }
}
