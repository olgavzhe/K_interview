# Overview

## Assumptions

### General

- Since it doesn't say anything about if PIM expects any feedback if all products were updated or not, the assumption is
  that PIM expects only 200 response and doesn't need to know if some products don't exist or were not updated
- The task is only about product update - no product create, no product delete
- No authentication/authorization towards Magento 2 ecomm or System A or System B
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

## Solution
I decided to use Magento 2 Message Queues as the main solution for the task.
Due to a risk of running out of time for the response to PIM(3 sec), using an async solution i see as a better approach.

### The Flow
A request from PIM comes to Magento 2 ecomm to the endpoint `/V1/kpim/products`(it is described in `Kpim_WebApi` module and it uses `Kpim_Integration` interface).
The request's payload is described as `Kpim\Integration\Api\Data\ProductInformationInterface`.
The endpoint is implemented in `Kpim_Pim` module. After the request came to the endpoint it's payload is published into two queues:
- __k.products.updated__ - a queue for products' ids(PIM id) that were received from PIM
- __k.product.update__ - a queue for each product from PIM's request that needs an update in Magento 2 ecomm

The __k.products.updated__ handler uses a service to notify System B about the latest updates.

The __k.product.update__ handler uses services to update Magento 2 ecomm product information and to dispatch an event *k_product_update_from_pim*.

The observer `Ksa\Update\Observer\ProductUpdateInformation` listens to the event *k_product_update_from_pim* and publishes a message to the Magento 2 Message Queue __k.system.a.product.update__.

The __k.system.a.product.update__ handler uses a service to notify System A about a product update.

### Structure

#### PIM

##### Kpim_Integration:

The module with API declarations for the Kpim_Pim module

##### Kpim_WebApi:

The module with a description of the web API for `Kpim_Integration`

##### Kpim_Pim:

The module implements interfaces from `Kpim_Integration`

- It saves all products' ids into the Magento 2 Message Queue - _k.products.updated_
- It saves each product from the request's payload as a separate message in the Magento 2 Message Queue - _k.product.update_

The module has a queue handler for the queue _k.product.update_.

- It updates Magento 2 product(no creation)
- It triggers a custom event - _k_product_update_from_pim_

The module has a queue handler for the queue _k.products.updated_

- It triggers a custom event - _k_latest_updated_products_

#### System A

##### Ksa_Update

The module has an observer that listens to the event _k_product_update_from_pim_. The observer saves a message to
Magento 2 Message Queue - _k.system.a.product.update_

It has the queue _k.system.a.product.update_ handler. It makes the update request to the System A.

#### System B

##### Ksb_Update

The module has an observer that listens to the event _k_latest_updated_products_. It updates the System B. 
