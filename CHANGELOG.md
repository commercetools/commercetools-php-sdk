### 1.0.0 Milestone 3
Major refactoring of the http client handling. Sphere client uses now PSR http messages for internal request and response representation and ships with a guzzle5 and guzzle6 http client adapter which will be automatically used. It's also possible to register new http client adapters implementing Sphere\Core\Client\Adapter\AdapterInterface

 * switch composer to caret operator
 * add redis to travis configuration
 * update customer create endpoint with API changes
 * add productSlug to LineItem
 * add homepage and support sections to composer.json
 * add accessor for adapter factory to client
 * [BREAKING] move guzzle to http client adapter to reduce dependencies
 * sphere client can use guzzle5 and guzzle6
 * [BREAKING] fix product variants mapping type
 * add price validity ranges
 * add php-intl as dependency to readme for development
 * [BREAKING] update price update and remove action to priceId
 * update links to documentation
 * [DEPRECATED] ProductSetMetaAttributesAction
 * add meta attribute update actions for categories
 * add meta attribute update actions for products
 * change userAgent signature
 * add missing type mappings to requests
 * [BREAKING] add required attributes to StateDraft add behat test for StateCreate
 * add ReviewCreateRequest
 * add CommentCreateRequest
 * add ProductDiscountCreateRequest
 * add ProductTypeCreateRequest
 * add hipchat notification
 * set values collection type only on deserialisation in AttributeType
 * FilterRange adds quotes to string and formats DateTime
 * add ShippingMethodCreateRequest
 * add InventoryCreateRequest
 * add InventoryEntry model
 * add DiscountCodeCreateRequest
 * add CustomerGroupCreateRequest
 * add ChannelCreateRequest
 * add CartDiscountCreateRequest
 * remove context type hint from TaxCategoryDraft
 * add zone create request
 * add context to ZoneDraft constructor
 * add tax category create request
 * add importOrder unit tests
 * add order import request and models
 * add sdk user agent to client header
 * expose headers and status code in response objects
 * refactor getters for results and facets in paged responses
 * fix bool filter more type safe filter to string conversion
 * more type safe filter to string conversion
 * fix multi facet and filter params
 * fix type of TaxRate

### 1.0.0 Milestone 2
 * add unit tests for query, fetch and delete requests
 * add tests for order and product update actions
 * add customer, category and cart update action tests
 * refactor annotation generator
 * refactor context aware objects to give a context callback to child
 * add constructor tests for update commands
 * add customer object and order create request test
 * add customer request tests
 * update Collection and JsonObject tests
 * add model unit tests
 * execute apigen only at master or tag changes
 * fix state and taxRate
 * add reference test
 * add typed objects for references
 * add currency formatter test
 * refactor collection and jsonObject
 * remove deprecated functions
 * add integration tests for category
 * refactor query parameters
 * add reference getter to JsonObject
 * return references only for documents
 * log deprecation headers
 * add pool size configuration to client
 * add future requests
 * add future tests
 * add toString to LocalizedSearchKeywords model
 * fix product draft tax category
 * add links to api documentation for models
 * correct type hints for zone requests
 * add links to api documentation for requests
 * add limit of update action logging to update requests
 * add cache adapter for redis storage

### 1.0.0 Milestone 1
 * batch execution of requests
 * delete, update, fetchById and query requests for all endpoints
 * cart create and update requests
 * cart update actions
 * order create and update requests
 * order update actions
 * customer create and update requests
 * customer update actions
 * customer sign-in, email verification and password requests
 * custom object create request
 * api result to object mapping

### 1.0.0 Milestone 0
 * initial commit
