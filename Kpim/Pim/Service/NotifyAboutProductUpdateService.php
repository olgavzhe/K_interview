<?php
declare(strict_types=1);

namespace Kpim\Pim\Service;

use Kpim\Integration\Api\Data\ProductInformationInterface;
use Magento\Framework\Event\ManagerInterface as EventManager;

class NotifyAboutProductUpdateService implements \Kpim\Integration\Api\NotifyAboutProductUpdateServiceInterface
{
    private $eventName;
    /**
     * @var EventManager
     */
    private $eventManager;

    public function __construct(
        EventManager $eventManager,
        string $eventName = 'k_product_update_from_pim'
    )
    {
        $this->eventManager = $eventManager;
        $this->eventName = $eventName;
    }

    /**
     * @inheritDoc
     */
    public function execute(ProductInformationInterface $productInformation): void
    {
        $this->eventManager->dispatch($this->eventName, ['product' => $productInformation]);
    }
}
