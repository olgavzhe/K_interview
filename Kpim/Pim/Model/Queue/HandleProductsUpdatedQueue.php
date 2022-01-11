<?php
declare(strict_types=1);

namespace Kpim\Pim\Model\Queue;

use Kpim\Integration\Api\NotifyAboutLatestUpdatedProductsServiceInterface;
use Magento\Framework\Serialize\SerializerInterface;

class HandleProductsUpdatedQueue
{
    /**
     * @var NotifyAboutLatestUpdatedProductsServiceInterface
     */
    private $notifyAboutLatestUpdatedProductsService;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(
        NotifyAboutLatestUpdatedProductsServiceInterface $notifyAboutLatestUpdatedProductsService,
        SerializerInterface $serializer
    )
    {
        $this->notifyAboutLatestUpdatedProductsService = $notifyAboutLatestUpdatedProductsService;
        $this->serializer = $serializer;
    }

    public function process(string $productIds)
    {
        $productIds = $this->serializer->unserialize($productIds);

        /**
         * Here are all validation to make sure $productIds is an array and has only ids
         */

        $this->notifyAboutLatestUpdatedProductsService->execute($productIds);
    }
}
