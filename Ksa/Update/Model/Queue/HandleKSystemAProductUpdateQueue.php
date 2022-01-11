<?php
declare(strict_types=1);

namespace Ksa\Update\Model\Queue;

use Kpim\Integration\Api\Data\ProductInformationInterface;
use Ksa\Update\Service\NotifySystemAService;

class HandleKSystemAProductUpdateQueue
{
    /**
     * @var NotifySystemAService
     */
    private $notifySystemAService;

    public function __construct(
        NotifySystemAService $notifySystemAService
    )
    {
        $this->notifySystemAService = $notifySystemAService;
    }

    public function process(ProductInformationInterface $productInformation): void
    {
        $this->notifySystemAService->execute($productInformation);
    }
}
