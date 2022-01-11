<?php
declare(strict_types=1);

namespace Kpim\Pim\Operation\Endpoint;

use Kpim\Integration\Api\Data\ProductInformationInterface;
use Kpim\Pim\Api\ProductsUpdatedPublisherInterface;
use Kpim\Pim\Api\ProductUpdatePublisherInterface;

class UpdateProductsInformation implements \Kpim\Integration\Api\UpdateProductsInformationEndpointInterface
{
    /**
     * @var ProductUpdatePublisherInterface
     */
    private $productUpdatePublisher;
    /**
     * @var ProductsUpdatedPublisherInterface
     */
    private $productsUpdatedPublisher;

    public function __construct(
        ProductUpdatePublisherInterface $productUpdatePublisher,
        ProductsUpdatedPublisherInterface $productsUpdatedPublisher
    )
    {
        $this->productsUpdatedPublisher = $productsUpdatedPublisher;
        $this->productUpdatePublisher = $productUpdatePublisher;
    }


    /**
     * @inheritDoc
     */
    public function execute($productsInformation)
    {
        /**
         * $productsInformation is an array with products
         *
         * [
         * {
         * "id": 1,
         * "name": "My Product",
         * "prices": {
         * "was": "123.45",
         * "now": "99.00"
         * },
         * "description": "This is a great product",
         * "images": [
         * "https://my-website.com/image1.jpg"
         * ],
         * "meta": {
         * "created_at": "2020-12-10 08:53:12",
         * "updated_at": "2020-12-10 18:42:57"
         * }
         * }
         * ]
         *
         */

        /**
         * Products ids can be taken from $productsInformation: $ids
         */
        $ids = [1, 2, 4, 6, 90];

        /**
         * Each individual product can be taken from $productsInformation and transformed into
         * Kpim\Integration\Api\Data\ProductInformationInterface objects: $productInformationArray
         */
        /** @var ProductInformationInterface[] $productInformationArray */
        $productInformationArray = [];

        /**
         * Publish $ids to a message queue
         */
        $this->productsUpdatedPublisher->execute($ids);

        /**
         * Publish each product as a message to a message queue
         */
        /** @var ProductInformationInterface $productInformation */
        foreach ($productInformationArray as $productInformation) {
            $this->productUpdatePublisher->execute($productInformation);
        }

        /**
         * Return 200 response
         */
    }
}
