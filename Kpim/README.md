# Overview

## Assumptions

### General

- Since it doesn't say anything about if PIM expects any feedback if all products were updated or not, the assumption is
  that PIM expects only 200 response and doesn't need to know if some products don't exist or were not updated
- The task is only about product update - no product create, no product delete
- No authentication/authorization towards Magento 2 ecomm or System A or System B

### Incoming Web Hook Payload

- `id` is PIM system product ID and is not related to product ID in Magento 2 system, but is used as SKU in Magento 2
### System A
- It doesn't say if the System A needs only products that were updated successfully in Magento 2, the assumption is that
the System A needs all data from the original PIM request regardless if products exist or were updated successfully in
Magento 2
- Magento 2 ecomm doesn't need to know about the response from System A - if it was successful or not
### System B

- It doesn't say if ids needs to be only for the products that are valid and were updated in M2. The assumption is that
  System B needs all ids from the original PIM request
- Magento 2 ecomm doesn't need to know about the response from System B - if it was successful or not

## General Notes


## Structure

### PIM

#### Kpim_Integration:

The module with API declarations for the Kpim_Pim module

#### Kpim_WebApi:

The module with a description of the web API for `Kpim_Integration`

#### Kpim_Pim:

The module implements interfaces from `Kpim_Integration`

- It saves all products' ids into the Magento 2 Message Queue - _k.products.updated_
- It saves each product from the request's payload as a separate message in the Magento 2 Message Queue - _k.product.update_

The module has a queue handler for the queue _k.product.update_.

- It updates Magento 2 product(no creation)
- It triggers a custom event - _k_product_update_from_pim_

The module has a queue handler for the queue _k.products.updated_

- It triggers a custom event - _k_latest_updated_products_

### System A

#### Ksa_Update

The module has an observer that listens to the event _k_product_update_from_pim_. The observer saves a message to
Magento 2 Message Queue - _k.system.a.product.update_

It has the queue _k.system.a.product.update_ handler. It makes the update request to the System A.

### System B

#### Ksb_Update

The module has an observer that listens to the event _k_latest_updated_products_. It updates the System B. 
