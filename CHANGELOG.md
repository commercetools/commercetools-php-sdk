<a name"1.0.0-RC1"></a>
### 1.0.0-RC1 (2015-07-27)


#### Bug Fixes

* **CustomerCreateRequest:** set correct return object class ([d1c100c9](https://github.com/sphereio/sphere-php-sdk/commit/d1c100c9), closes [#109](https://github.com/sphereio/sphere-php-sdk/issues/109))
* **Requests:** fix the usage of relative path by requests ([e32d0150](https://github.com/sphereio/sphere-php-sdk/commit/e32d0150))
* **Order:** set correct return type for order discountCodes ([5bbf4f14](https://github.com/sphereio/sphere-php-sdk/commit/5bbf4f14))


#### Features

* **AnnotationGenerator:** add magic method getAt and current with correct type hint to collections ([324886db](https://github.com/sphereio/sphere-php-sdk/commit/324886db))
* **Attribute:** add feature to set attribute type definitions to attributes ([37546b33](https://github.com/sphereio/sphere-php-sdk/commit/37546b33))
* **AttributeCollection:** add feature to set attribute type definitions to attribute collection ([af3b558a](https://github.com/sphereio/sphere-php-sdk/commit/af3b558a))
* **CartDiscount:** add update actions ([c0e27dd5](https://github.com/sphereio/sphere-php-sdk/commit/c0e27dd5))
* **Channel:**
  * add product distribution channel to line items and channel roles ([fdc4ed82](https://github.com/sphereio/sphere-php-sdk/commit/fdc4ed82), closes [#120](https://github.com/sphereio/sphere-php-sdk/issues/120))
  * add update actions ([b355e9aa](https://github.com/sphereio/sphere-php-sdk/commit/b355e9aa))
* **Client:** add named constructor to Client and Config object ([1a0c350f](https://github.com/sphereio/sphere-php-sdk/commit/1a0c350f), closes [#101](https://github.com/sphereio/sphere-php-sdk/issues/101))
* **Comments:** add update actions ([54804bf1](https://github.com/sphereio/sphere-php-sdk/commit/54804bf1))
* **CustomerGroups:** add update actions ([30789b76](https://github.com/sphereio/sphere-php-sdk/commit/30789b76))
* **DiscountCodes:** add update actions ([e3357965](https://github.com/sphereio/sphere-php-sdk/commit/e3357965))
* **Exceptions:** wrap http client exceptions ([a169611b](https://github.com/sphereio/sphere-php-sdk/commit/a169611b))
* **Inventory:** add update actions ([12ea56d5](https://github.com/sphereio/sphere-php-sdk/commit/12ea56d5))
* **JsonObject:** add magic getter to access object data as property ([7a22cfa7](https://github.com/sphereio/sphere-php-sdk/commit/7a22cfa7))
* **ProductDiscounts:** add update actions ([24bd9afb](https://github.com/sphereio/sphere-php-sdk/commit/24bd9afb))
* **ProductTypes:** add update actions ([50616ef8](https://github.com/sphereio/sphere-php-sdk/commit/50616ef8))
* **Project:** add project fetch request ([4e8d232c](https://github.com/sphereio/sphere-php-sdk/commit/4e8d232c), closes [#35](https://github.com/sphereio/sphere-php-sdk/issues/35))
* **Requests:**
  * add executeWithClient and mapResponse function with correct type hints ([8cb1b2cc](https://github.com/sphereio/sphere-php-sdk/commit/8cb1b2cc))
  * add withTotal flag for query speed optimization ([b7892401](https://github.com/sphereio/sphere-php-sdk/commit/b7892401))
* **Review:** add update actions ([4f1d55c8](https://github.com/sphereio/sphere-php-sdk/commit/4f1d55c8))
* **ShippingMethod:**
  * add update actions ([46993be2](https://github.com/sphereio/sphere-php-sdk/commit/46993be2))
  * add shipping method getByCartId and getByLocation ([cb522923](https://github.com/sphereio/sphere-php-sdk/commit/cb522923))
* **State:** add update actions ([3833ad1d](https://github.com/sphereio/sphere-php-sdk/commit/3833ad1d))
* **TaxCategory:** add update actions ([428ba25a](https://github.com/sphereio/sphere-php-sdk/commit/428ba25a))
* **Zones:** add update actions ([a74c3517](https://github.com/sphereio/sphere-php-sdk/commit/a74c3517))


#### Breaking Changes

* QueryRequests renamed to singular form

  To streamline the naming schemes between the SDKs QueryRequests have been renamed to their singular form. E.g.:

  Before:

  ```
  $request = CategoriesQueryRequest::of();
  ```

  After:

  ```
  $request = CategoryQueryRequest::of();
  ```

 ([8de23283](https://github.com/sphereio/sphere-php-sdk/commit/8de23283))
* SingleResourceResponse renamed to ResourceResponse

  To streamline the naming schemes between the SDKs SingleResourceResponse has been renamed to ResourceResponse

 ([4199c815](https://github.com/sphereio/sphere-php-sdk/commit/4199c815))
* ImportLineItem renamed to LineItemImportDraft

  To streamline the naming schemes between the SDKs ImportProductVariant, ImportLineItem and ImportLineItemCollection
  have been renamed to ProductVariantImportDraft, LineItemImportDraft and LineItemImportDraftCollection.

 ([018c7493](https://github.com/sphereio/sphere-php-sdk/commit/018c7493))
* CartDiscountCodeReference renamed to DiscountCodeInfo

  To streamline the naming schemes between the SDKs CartDiscountCodeReference has been renamed to DiscountCodeInfo

 ([db14db07](https://github.com/sphereio/sphere-php-sdk/commit/db14db07))
* DeleteById requests renamed to Delete requests

  To streamline the naming schemes between the SDKs delete requests have been renamed. E.g.:

  Before:

  ```
  $request = ProductDeleteByIdRequest::ofIdAndVersion('<id>', <version>);
  ```

  After:

  ```
  $request = ProductDeleteRequest::ofIdAndVersion('<id>', <version>);
  ```

  ([896e95a9](https://github.com/sphereio/sphere-php-sdk/commit/896e95a9))
* FetchBy requests renamed to ByGetRequest

  To streamline the naming schemes between the SDKs FetchBy requests have been renamed to ByGet requests. E.g.:

  Before:

  ```
  $request = ProductFetchByIdRequest::ofId('<id>');
  ```

  After:

  ```
  $request = ProductByIdGetRequest::ofId('<id>');
  ```

  ([d601dcfc](https://github.com/sphereio/sphere-php-sdk/commit/d601dcfc))
* Document has been renamed to Resource

  To streamline the naming schemes between the SDKs Document has been renamed to Resource. Type checks have to be adjusted

  Before:

  ```
  if ($object instanceof \Sphere\Core\Model\Common\Document)
  ```

  After:

  ```
  if ($object instanceof \Sphere\Core\Model\Common\Resource)
  ```

  ([5704fa3e](https://github.com/sphereio/sphere-php-sdk/commit/5704fa3e))
* ProductSearchEndpoint has been renamed

  Before:

  ```
  $endpoint = ProductSearchEndpoint::endpoint();
  ```

  After:

  ```
  $endpoint = ProductProjectionEndpoint::endpoint();
  ```

  closes [#103](https://github.com/sphereio/sphere-php-sdk/issues/103)

  ([e1b6989f](https://github.com/sphereio/sphere-php-sdk/commit/e1b6989f))
* ProductsSearchRequest has been renamed

  Before:

  ```
  $request = ProductsSearchRequest::of();
  ```

  After:

  ```
  $request = ProductProjectionSearchRequest::of();
  ```

  closes [#103](https://github.com/sphereio/sphere-php-sdk/issues/103)

  ([bd1bf7b1](https://github.com/sphereio/sphere-php-sdk/commit/bd1bf7b1))
* config object fromArray method is declared static

  Before:

	```
	$config = new Config();
	$config->fromArray($configArray);
	```

	After:

	```
	$config = Config::fromArray($configArray);
	```

  closes [#101](https://github.com/sphereio/sphere-php-sdk/issues/101)

  ([1a0c350f](https://github.com/sphereio/sphere-php-sdk/commit/1a0c350f))
* ext-intl is now mandatory

  ([2afea8ad](https://github.com/sphereio/sphere-php-sdk/commit/2afea8ad))
* getters return null if value is not set

  To have a more reliable return values the implied instantiation of empty objects has been removed. This means before using a value is must be set explicit. Example for collections

  Before:

  ```
  $obj = ProductTypeDraft::ofNameAndDescription('test', 'test');
  $obj->getAttributes()->add(AttributeDefinition::of()->setName('test'));
  ```

  After:

  ```
  $obj = ProductTypeDraft::ofNameAndDescription('test', 'test');
  $obj->setAttributes(AttributeDefinitionCollection::of()->add(AttributeDefinition::of()->setName('test')));
  ```

  Closes [#113](https://github.com/sphereio/sphere-php-sdk/issues/113)

  ([8b138e7b](https://github.com/sphereio/sphere-php-sdk/commit/8b138e7b))
* all http client exceptions are now wrapped inside the SphereException hierarchy

  Before:

  ```
  try {
      $response = $client->execute($request)
	} catch(\GuzzleHttp\Exception\RequestException $e) {
		...
	}
  ```

  After:

  ```
  try {
      $response = $client->execute($request)
	} catch(\Sphere\Core\Error\SphereException $e) {
		...
	}
  ```

 ([a169611b](https://github.com/sphereio/sphere-php-sdk/commit/a169611b))
* rename client method future to executeAsync

  To streamline the request executing methods the future method has been renamed. To migrate the code follow the example:

  Before:

  ```
  $response = $client->future($request);
  ```

  After:

  ```
  $response = $client->executeAsync($request);
  ```

  ([51da11fa](https://github.com/sphereio/sphere-php-sdk/commit/51da11fa))
* changes the static "of" constructor to named constructors

  The static constructor "of" for models and requests needs magic methods in the class header to provide proper IDE support. By using the library as a dependency the magic methods were not correctly used by the IDE. Also the reflection used inside the OfTrait is not the best solution. So now all models and requests should have one or more named constructors which can be properly read by most IDE, don't require reflection for instantiation and can create instances without parameters which is helpful for testing purposes.

  * constructor of Models and Requests doesn't have required values anymore
  * static "of" constructor instantiates class with given context object. Use named constructors for instantiating models or requests with arguments

  ([d19a83c1](https://github.com/sphereio/sphere-php-sdk/commit/d19a83c1))

### 1.0.0-beta.2 (Milestone 3)
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

### 1.0.0-beta.1 (Milestone 2)
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
