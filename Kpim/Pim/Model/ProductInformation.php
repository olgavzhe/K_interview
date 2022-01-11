<?php
declare(strict_types=1);

namespace Kpim\Pim\Model;

/**
 * Class ProductInformation
 * @package Kpim\Pim\Model
 */
class ProductInformation implements \Kpim\Integration\Api\Data\ProductInformationInterface
{
    private $sku = '';
    private $name = '';
    private $description = '';
    private $images = [];
    private $meta = [];
    private $priceWas = 0.0;
    private $priceNow = 0.0;

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPriceWas(): float
    {
        return $this->priceWas;
    }

    public function setPriceWas(float $price): void
    {
        $this->priceWas = $price;
    }

    public function getPriceNow(): float
    {
        return $this->priceNow;
    }

    public function setPriceNow(float $price): void
    {
        $this->priceNow = $price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function setImages(array $images): void
    {
        $this->images = $images;
    }

    public function getMeta(): array
    {
        return $this->meta;
    }

    public function setMeta(array $meta): void
    {
        $this->meta = $meta;
    }
}
