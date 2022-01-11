<?php
declare(strict_types=1);

namespace Ksb\Update\Observer;

use Magento\Framework\Event\Observer;
use Ksb\Update\Service\NotifySystemBService;

class ProductUpdateInformation implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var NotifySystemBService
     */
    private $notifySystemBService;

    public function __construct(
        NotifySystemBService $notifySystemBService
    )
    {
        $this->notifySystemBService = $notifySystemBService;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        $productIds = $observer->getData('ids');
        $this->notifySystemBService->execute($productIds);
    }
}
