<?php
declare(strict_types=1);

namespace Kpim\Pim\Service;

use Kpim\Integration\Api\Data\ProductInformationInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class UpdateProductInformationService implements \Kpim\Integration\Api\UpdateProductInformationServiceInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository
    )
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @inheritDoc
     */
    public function execute(ProductInformationInterface $productInformation): bool
    {
        try {
            $product = $this->productRepository->get($productInformation->getSku());
        } catch (NoSuchEntityException $exception) {
            /**
             * Handle the situation
             */
            return false;
        }

        /**
         * Set only product name and price
         */

        try {
            $this->productRepository->save($product);
        } catch (\Exception $exception) {
            /**
             * Handle the situation
             */
            return false;
        }
        return true;
    }
}
