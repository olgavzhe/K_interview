<?php
declare(strict_types=1);

namespace Kpim\Pim\Service;

use Magento\Framework\Event\ManagerInterface as EventManager;

class NotifyAboutLatestUpdatedProductsService implements \Kpim\Integration\Api\NotifyAboutLatestUpdatedProductsServiceInterface
{
    private $eventName;
    /**
     * @var EventManager
     */
    private $eventManager;

    public function __construct(
        EventManager $eventManager,
        string $eventName = 'k_latest_updated_products'
    )
    {
        $this->eventManager = $eventManager;
        $this->eventName = $eventName;
    }

    /**
     * @inheritDoc
     */
    public function execute(array $productIds): void
    {
        $this->eventManager->dispatch($this->eventName, ['ids' => $productIds]);
    }
}
