<?php
declare(strict_types=1);

namespace Kpim\Integration\Api\Data;
/**
 * Interface ProductInformationInterface
 * @package Kpim\Integration\Api\Data
 */
interface ProductInformationInterface
{
    /*
     * {
    "id": 1,
    "name": "My Product",
    "prices": {
    "was": "123.45",
    "now": "99.00"
    },
    "description": "This is a great product",
    "images": [
    "https://my-website.com/image1.jpg"
    ],
    "meta": {
    "created_at": "2020-12-10 08:53:12",
    "updated_at": "2020-12-10 18:42:57"
    }
    }
     */
    public function getSku(): string;

    public function setSku(string $sku): void;

    public function getName(): string;

    public function setName(string $name): void;

    public function getPriceWas(): float;

    public function setPriceWas(float $price): void;

    public function getPriceNow(): float;

    public function setPriceNow(float $price): void;

    public function getDescription(): string;

    public function setDescription(string $description): void;

    public function getImages(): array;

    public function setImages(array $images): void;

    public function getMeta(): array;

    public function setMeta(array $meta): void;
}
