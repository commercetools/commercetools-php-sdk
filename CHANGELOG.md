<a name="1.0.0-RC12"></a>
# [1.0.0-RC12](https://github.com/sphereio/commercetools-php-sdk/compare/v1.0.0-RC11...v1.0.0-RC12) (2016-05-02)


### Bug Fixes

* **Cart:** fix type of custom line-item slug ([34367d5](https://github.com/sphereio/commercetools-php-sdk/commit/34367d5))
* **CustomLineItem:** fix type of slug in custom line-item ([d8d7d2a](https://github.com/sphereio/commercetools-php-sdk/commit/d8d7d2a))

### Features

* **Cart:** add helper to calculate line item count ([291bd05](https://github.com/sphereio/commercetools-php-sdk/commit/291bd05))
* **Client:** add support for oauth password and refresh token flow ([fe23c8b](https://github.com/sphereio/commercetools-php-sdk/commit/fe23c8b)), closes [#191](https://github.com/sphereio/commercetools-php-sdk/issues/191)
* **Error:** add oauth error classes ([92eec57](https://github.com/sphereio/commercetools-php-sdk/commit/92eec57))
* **Product:** add support to use sku to identify a product variant in update action ([7f1979b](https://github.com/sphereio/commercetools-php-sdk/commit/7f1979b)), closes [#192](https://github.com/sphereio/commercetools-php-sdk/issues/192)
* **Reference:** add constructor ofKey constructor to references ([e6fafc3](https://github.com/sphereio/commercetools-php-sdk/commit/e6fafc3))



<a name="1.0.0-RC11"></a>
# [1.0.0-RC11](https://github.com/sphereio/commercetools-php-sdk/compare/v1.0.0-RC10...v1.0.0-RC11) (2016-04-06)


### Bug Fixes

* **Product:** change type of price collection ([8cc1262](https://github.com/sphereio/commercetools-php-sdk/commit/8cc1262))

### Code Refactoring

* **Customer:** adjust customer email verification request to API changes ([2e3dd32](https://github.com/sphereio/commercetools-php-sdk/commit/2e3dd32))
* **Customer:** adjust customer password change request to API changes ([318e93f](https://github.com/sphereio/commercetools-php-sdk/commit/318e93f))

### Features

* **Client:** add support for oauth scopes ([5545dfd](https://github.com/sphereio/commercetools-php-sdk/commit/5545dfd))
* **Client:** log response body and headers of api exceptions ([f371979](https://github.com/sphereio/commercetools-php-sdk/commit/f371979)), closes [#186](https://github.com/sphereio/commercetools-php-sdk/issues/186)
* **Product:** add update action for stageable SKU ([870a1f8](https://github.com/sphereio/commercetools-php-sdk/commit/870a1f8))
* **Response:** add getter for correlation id ([6029a02](https://github.com/sphereio/commercetools-php-sdk/commit/6029a02)), closes [#69](https://github.com/sphereio/commercetools-php-sdk/issues/69)


### BREAKING CHANGES

* Product: renamed the ProductSetSKUAction to ProductSetSKUNotStageableAction

  Before:
  
  ```
  ProductSetSKUAction::ofVariantId()
  ```

  After:
  
  ```
  ProductSetSKUNotStageableAction::ofVariantId() // old behavior action
  ProductSetSkuAction::ofVariantId() // stageable action
  ```
* Product: fix type of price collections
  
  Before:
  
  ```
  ProductAddVariantAction::of()->setPrices(PriceCollection::of()->add(Price::of()))
  ```

  After:
  
  ```
  ProductAddVariantAction::of()->setPrices(PriceDraftCollection::of()->add(PriceDraft::of()))
  ```
* Customer: adjust customer email verification request to API changes

  Before:
  
  ```
  CustomerEmailConfirmRequest::ofIdVersionAndToken($id, $version, $token)
  ```

  After:
  
  ```
  CustomerEmailConfirmRequest::ofToken($token)
  ```
* Customer: adjust customer password change request to API changes

  Before:
  
  ```
  CustomerPasswordResetRequest::ofIdVersionTokenAndPassword($id, $version, $token, $newPassword)
  ```

  After:
  
  ```
  CustomerPasswordResetRequest::ofTokenAndPassword($token, $newPassword)
  ```



<a name="1.0.0-RC10"></a>
# [1.0.0-RC10](https://github.com/sphereio/commercetools-php-sdk/compare/v1.0.0-RC9...v1.0.0-RC10) (2016-03-22)


### Bug Fixes

* **CartDiscount:** fix cart discount target with correct type ([220c1da](https://github.com/sphereio/commercetools-php-sdk/commit/220c1da))
* **Client:** fix guzzle5 adapter to send user agent ([3ae8748](https://github.com/sphereio/commercetools-php-sdk/commit/3ae8748))
* **Collection:** fix add function for collection ([993cddd](https://github.com/sphereio/commercetools-php-sdk/commit/993cddd))
* **Collection:** fix collection iterator for associative collections ([2442677](https://github.com/sphereio/commercetools-php-sdk/commit/2442677))
* **Customer:** fix exception on getDefaultAddresses for empty customer address ([7bd63a4](https://github.com/sphereio/commercetools-php-sdk/commit/7bd63a4))
* **DateDecorator:** fix date overflow for date decorator on serialization ([9009b8f](https://github.com/sphereio/commercetools-php-sdk/commit/9009b8f))
* **Inventory:** fix setSupplyChannel action for inventory update ([f356179](https://github.com/sphereio/commercetools-php-sdk/commit/f356179))
* **LocalizedString:** use graceful flag for language property getter ([621195d](https://github.com/sphereio/commercetools-php-sdk/commit/621195d))
* **Payment:** correct type mapping for transaction state ([0c6f36d](https://github.com/sphereio/commercetools-php-sdk/commit/0c6f36d))
* **Reference:** remove obj from serialized result if resource is embedded ([79f8cba](https://github.com/sphereio/commercetools-php-sdk/commit/79f8cba))
* **Review:** fix locale serialization for review models ([973129d](https://github.com/sphereio/commercetools-php-sdk/commit/973129d))

### Features

* **Category:** add metaDescription, metaKeywords, metaTitle to Category and CategoryDraft model ([5468676](https://github.com/sphereio/commercetools-php-sdk/commit/5468676))
* **Customer:** add update actions to set customer's firstName, middleName, lastName and title ([b122225](https://github.com/sphereio/commercetools-php-sdk/commit/b122225))
* **GraphQL:** add request to query GraphQL endpoint ([182641a](https://github.com/sphereio/commercetools-php-sdk/commit/182641a))
* **LineItem:** add helper function to calculate discounted price ([961a493](https://github.com/sphereio/commercetools-php-sdk/commit/961a493))
* **Payment:** add change amount planned update action ([2815f98](https://github.com/sphereio/commercetools-php-sdk/commit/2815f98))
* **Product:** add product setCategoryOrderHint action ([9f8de04](https://github.com/sphereio/commercetools-php-sdk/commit/9f8de04))
* **Product:** add set prices update action ([a8c4206](https://github.com/sphereio/commercetools-php-sdk/commit/a8c4206))
* **ProductSearch:** support POST for filters and facets ([caeb0a5](https://github.com/sphereio/commercetools-php-sdk/commit/caeb0a5))
* **ProductType:** add change isSearchable update action ([95395f9](https://github.com/sphereio/commercetools-php-sdk/commit/95395f9))
* **ProductType:** add inputTip to attribute definition ([09288a4](https://github.com/sphereio/commercetools-php-sdk/commit/09288a4))
* **ProductType:** add key to product type ([4e1d393](https://github.com/sphereio/commercetools-php-sdk/commit/4e1d393))
* **Review:** add by key requests ([ebc4ece](https://github.com/sphereio/commercetools-php-sdk/commit/ebc4ece))
* **Review:** add update by key request ([710c89e](https://github.com/sphereio/commercetools-php-sdk/commit/710c89e))
* **Review:** update Review requests and models to API changes ([6634658](https://github.com/sphereio/commercetools-php-sdk/commit/6634658))
* **ShippingMethod:** add delete request for shipping methods ([e5510f6](https://github.com/sphereio/commercetools-php-sdk/commit/e5510f6))
* **State:** add set, add and remove roles update action ([7c9a28d](https://github.com/sphereio/commercetools-php-sdk/commit/7c9a28d))
* **Type:** add by key delete requests ([509616f](https://github.com/sphereio/commercetools-php-sdk/commit/509616f))
* **Type:** add type change key action ([1c2ebf4](https://github.com/sphereio/commercetools-php-sdk/commit/1c2ebf4))
* **Type:** add type update by key request ([72e4bd2](https://github.com/sphereio/commercetools-php-sdk/commit/72e4bd2))
* **Types:** add delete type by key request ([2450b7a](https://github.com/sphereio/commercetools-php-sdk/commit/2450b7a))
* **Types:** add request to get type by key ([2b34ae9](https://github.com/sphereio/commercetools-php-sdk/commit/2b34ae9)), closes [#169](https://github.com/sphereio/commercetools-php-sdk/issues/169)

### DEPRECATION NOTE
Facet, Filter, FilterRange and FilterRangeCollection in namespace Commercetools\Core\Model\Product have been marked as deprecated and will be removed in v1.0.0. Please use the classes found in namespace Commercetools\Core\Model\Product\Search instead.

### BREAKING CHANGES
* Changed named constructors for type update actions
  
  Before:
  
  ```
  TypeAddLocalizedEnumValueAction::ofEnum(...)
  TypeAddEnumValueAction::ofEnum(...)
  TypeChangeEnumValueOrderAction::ofEnums(...)
  TypeChangeLocalizedEnumValueOrderAction::ofEnums(...)
  TypeChangeLabelAction::ofLabel(...)
  ```
  
  After:
  
  ```
  TypeAddLocalizedEnumValueAction::ofNameAndEnum(...)
  TypeAddEnumValueAction::ofNameAndEnum(...)
  TypeChangeEnumValueOrderAction::ofNameAndEnums(...)
  TypeChangeLocalizedEnumValueOrderAction::ofNameAndEnums(...)
  TypeChangeLabelAction::ofNameAndLabel(...)
  ```



<a name="1.0.0-RC9"></a>
# [1.0.0-RC9](https://github.com/sphereio/commercetools-php-sdk/compare/v1.0.0-RC8...v1.0.0-RC9) (2016-01-11)


### Bug Fixes

* **Collection:** fix serialization of collection with primitive types ([0e1251f](https://github.com/sphereio/commercetools-php-sdk/commit/0e1251f))
* **CustomField:** fix custom field object draft to reflect API changes ([90156aa](https://github.com/sphereio/commercetools-php-sdk/commit/90156aa))
* **CustomFields:** fix custom type update actions to match changed API ([26efdcf](https://github.com/sphereio/commercetools-php-sdk/commit/26efdcf))
* **CustomObject:** remove type for custom object value ([b37c604](https://github.com/sphereio/commercetools-php-sdk/commit/b37c604)), closes [#163](https://github.com/sphereio/commercetools-php-sdk/issues/163)
* **Product:** fix type of priceId ([23c2de5](https://github.com/sphereio/commercetools-php-sdk/commit/23c2de5))
* **ProductProjection:** fix context of getAllVariants helper method ([28526db](https://github.com/sphereio/commercetools-php-sdk/commit/28526db))

### Features

* **Cart:** add fields to cart draft ([8b2ab3b](https://github.com/sphereio/commercetools-php-sdk/commit/8b2ab3b))
* **Category:** add CategoryCreated and CategorySlugChanged messages ([014dde2](https://github.com/sphereio/commercetools-php-sdk/commit/014dde2))
* **CategoryCollection:** add getById to CategoryCollection ([1a79cbc](https://github.com/sphereio/commercetools-php-sdk/commit/1a79cbc))
* **Channel:** add custom field to channel ([5e9601d](https://github.com/sphereio/commercetools-php-sdk/commit/5e9601d))
* **Client:** add config option for accept encoding (e.g. enabling gzip compression) ([c57f2ee](https://github.com/sphereio/commercetools-php-sdk/commit/c57f2ee))
* **Client:** add gzip as default acceptEncoding ([2ddd99d](https://github.com/sphereio/commercetools-php-sdk/commit/2ddd99d))
* **CurrencyFormatter:** change currencyFormatter to use fraction digits from intl extension ([e8d058b](https://github.com/sphereio/commercetools-php-sdk/commit/e8d058b))
* **Customer:** add CustomerCreated message ([12c9bff](https://github.com/sphereio/commercetools-php-sdk/commit/12c9bff))
* **Customer:** add getter for default shipping and billing address ([7b776f9](https://github.com/sphereio/commercetools-php-sdk/commit/7b776f9)), closes [#162](https://github.com/sphereio/commercetools-php-sdk/issues/162)
* **CustomFields:** update custom field draft to API changes ([dfae984](https://github.com/sphereio/commercetools-php-sdk/commit/dfae984))
* **CustomObject:** add delete by id request ([9eb8ba7](https://github.com/sphereio/commercetools-php-sdk/commit/9eb8ba7))
* **Inventory:** add SetSupplyChannel action ([d453e5e](https://github.com/sphereio/commercetools-php-sdk/commit/d453e5e))
* **Payment:** add change transaction state, timestamp and interactionId actions ([3eee823](https://github.com/sphereio/commercetools-php-sdk/commit/3eee823))
* **Payment:** add PaymentTransactionChanged message ([7c3e6d8](https://github.com/sphereio/commercetools-php-sdk/commit/7c3e6d8))
* **Payment:** add state and id to payment transaction ([b7ee577](https://github.com/sphereio/commercetools-php-sdk/commit/b7ee577))
* **Product:** add price field to variant for price selection ([ea8169e](https://github.com/sphereio/commercetools-php-sdk/commit/ea8169e))
* **Product:** add ProductCreated and ProductSlugChanged messages ([dbb8a28](https://github.com/sphereio/commercetools-php-sdk/commit/dbb8a28))
* **Product:** support resource identifier for product type at product creation ([d7e1980](https://github.com/sphereio/commercetools-php-sdk/commit/d7e1980))
* **ProductSearch:** add matching variant to ProductVariant object ([2e336df](https://github.com/sphereio/commercetools-php-sdk/commit/2e336df))
* **ProductSearch:** add price select methods for search ([ad8b4cd](https://github.com/sphereio/commercetools-php-sdk/commit/ad8b4cd))
* **ProductSearch:** add price select methods to ProductProjectionSearchRequest ([51f889d](https://github.com/sphereio/commercetools-php-sdk/commit/51f889d))
* **ProductSearch:** add price select parameters ([f1717b8](https://github.com/sphereio/commercetools-php-sdk/commit/f1717b8))
* **ProductType:** add get, update and delete by key requests ([0ad3973](https://github.com/sphereio/commercetools-php-sdk/commit/0ad3973))
* **ProductType:** add getByName and getById to ProductTypeCollection ([2b2e005](https://github.com/sphereio/commercetools-php-sdk/commit/2b2e005))
* **Request:** add min and max for query limit ([66947e6](https://github.com/sphereio/commercetools-php-sdk/commit/66947e6))


### BREAKING CHANGES

* CustomObject: CustomObjectCreateRequest expects CustomObjectDraft object

  Before:
  ```
  $request = CustomObjectCreateRequest::ofObject(CustomObject::of()->setContainer('test')->setKey('test-key')->setValue(json_encode($value)));
  ```

  After:
  ```
  $request = CustomObjectCreateRequest::ofObject(CustomObjectDraft::ofContainerKeyAndValue('test', 'test-key', $value));
  ```
* CustomFields: the type reference had been changed at the API

  Before:
  ```
  $customFieldObjectDraft->setTypeId('type-12345');
  $customFieldObjectDraft->setTypeKey('type-key');
  ```

  After:
  ```
  $customFieldObjectDraft->setType(TypeReference::ofId('type-12345'));
  $customFieldObjectDraft->setType(TypeReference::ofKey('type-key'));
  ```



<a name="1.0.0-RC8"></a>
# [1.0.0-RC8](https://github.com/sphereio/commercetools-php-sdk/compare/v1.0.0-RC7...v1.0.0-RC8) (2015-10-30)


### Bug Fixes

* **Cart:** typo in custom line item model ([c583fb9](https://github.com/sphereio/commercetools-php-sdk/commit/c583fb9))
* **JsonObject:** add missing static keyword to named constructors ([f83e4c6](https://github.com/sphereio/commercetools-php-sdk/commit/f83e4c6))
* **JsonObject:** fix error message for unknown method ([22431f8](https://github.com/sphereio/commercetools-php-sdk/commit/22431f8))
* **Payment:** add missing type for payment transactions ([c6d3765](https://github.com/sphereio/commercetools-php-sdk/commit/c6d3765))
* **Payment:** correct type for PaymentInfo model ([b942a06](https://github.com/sphereio/commercetools-php-sdk/commit/b942a06))

### Features

* **CustomFields:** add customs fields and types for prices ([cfbc0bb](https://github.com/sphereio/commercetools-php-sdk/commit/cfbc0bb)), closes [#156](https://github.com/sphereio/commercetools-php-sdk/issues/156)
* **ImportOrder:** add custom fields to ImportOrder ([008702f](https://github.com/sphereio/commercetools-php-sdk/commit/008702f))
* **Order:** add order delete request ([5944de7](https://github.com/sphereio/commercetools-php-sdk/commit/5944de7))


### BREAKING CHANGES

* added PriceDraft to price update actions

  The new PriceDraft object has been added as type hint to ProductAddPriceAction and ProductChangePriceAction. The ProductVariantDraft expects now a PriceDraftCollection


<a name="1.0.0-RC7"></a>
# [1.0.0-RC7](https://github.com/sphereio/commercetools-php-sdk/compare/v1.0.0-RC5...v1.0.0-RC7) (2015-10-19)


### Bug Fixes

* **Cart:** add corrected cart discount fields ([b0bf1b7](https://github.com/sphereio/commercetools-php-sdk/commit/b0bf1b7))
* **LocalizedString:** fix array conversion of locales for LocalizedString ([ea50790](https://github.com/sphereio/commercetools-php-sdk/commit/ea50790))
* **PaymentInfo** correct class path ([a9501fc](https://github.com/sphereio/commercetools-php-sdk/commit/a9501fc))

### Features

* **JsonObject:** recurse toArray method to child objects ([feb3729](https://github.com/sphereio/commercetools-php-sdk/commit/feb3729))

### BREAKING CHANGES

* discountedPrice at LineItems has been removed

  The discountedPrice field has been deprecated at the API and therefor was removed from the SDK.

  Before:
  ```
  $lineItem->getDiscountedPrice();
  $discountedCentAmount = $lineItem->getDiscountedPrice()->getValue()->getCentAmount();
  ```

  After:

  ```
  $lineItem->getDiscountedPricePerQuantity();
  $discountedCentAmount = 0;
  foreach ($lineItem->getDiscountedPricePerQuantity() as $discountedPricePerQuantity) {
    $discountedCentAmount += $discountedPricePerQuantity()->getQuantity() *
      $discountedPricePerQuantity->getDiscountedPrice()->getValue()->getCentAmount();
  }
  ```
  ([b0bf1b7](https://github.com/sphereio/commercetools-php-sdk/commit/b0bf1b7))

<a name="1.0.0-RC5"></a>
# [1.0.0-RC5](https://github.com/sphereio/commercetools-php-sdk/compare/v1.0.0-RC4...v1.0.0-RC5) (2015-10-07)


### Features

* **LineItems:** add update actions for custom types on line items ([c64fad0](https://github.com/sphereio/commercetools-php-sdk/commit/c64fad0))
* **Payment:** add payment info to cart and order ([e279d1a](https://github.com/sphereio/commercetools-php-sdk/commit/e279d1a))
* **Payment:** add payment update actions for cart and order ([13e1860](https://github.com/sphereio/commercetools-php-sdk/commit/13e1860))



<a name="1.0.0-RC4"></a>
# [1.0.0-RC4](https://github.com/sphereio/commercetools-php-sdk/compare/v1.0.0-RC3...v1.0.0-RC4) (2015-10-05)


### Bug Fixes

* **Cart:** fix addCustomLineItem update action ([b2d704f](https://github.com/sphereio/commercetools-php-sdk/commit/b2d704f)), closes [#154](https://github.com/sphereio/commercetools-php-sdk/issues/154)
* **CustomTypes:** update to breaking changes of the API ([5e23104](https://github.com/sphereio/commercetools-php-sdk/commit/5e23104))
* **Product:** fix type for remove price action ([c0a5ccc](https://github.com/sphereio/commercetools-php-sdk/commit/c0a5ccc)), closes [#153](https://github.com/sphereio/commercetools-php-sdk/issues/153)

### Features

* **Order:** add state to order ([3a6cc3d](https://github.com/sphereio/commercetools-php-sdk/commit/3a6cc3d))
* **Payment:** add payment messages ([b9308c1](https://github.com/sphereio/commercetools-php-sdk/commit/b9308c1))
* **Payment:** add payment requests and models ([c720eed](https://github.com/sphereio/commercetools-php-sdk/commit/c720eed))
* **Product:** add state to product ([95437d8](https://github.com/sphereio/commercetools-php-sdk/commit/95437d8))
* **ProductSearch:** add fuzzy flag to product search request ([0ed8dc8](https://github.com/sphereio/commercetools-php-sdk/commit/0ed8dc8))
* **Review:** add state to review ([8278313](https://github.com/sphereio/commercetools-php-sdk/commit/8278313))


### BREAKING CHANGES

* update actions for changing the order of custom fields have been changed


<a name="1.0.0-RC3"></a>
# [1.0.0-RC3](https://github.com/sphereio/commercetools-php-sdk/compare/v1.0.0-RC2...v1.0.0-RC3) (2015-09-10)


### Bug Fixes

* **Comment:** delete comment endpoint functionality ([506644c](https://github.com/sphereio/commercetools-php-sdk/commit/506644c))
* **OAuthManager:** don't expose api credentials through exception callstack ([f0caaa1](https://github.com/sphereio/commercetools-php-sdk/commit/f0caaa1))
* **ProductDraft:** use ProductVariantDraftCollection for variants ([f252a2d](https://github.com/sphereio/commercetools-php-sdk/commit/f252a2d)), closes [#142](https://github.com/sphereio/commercetools-php-sdk/issues/142)

### Features

* **CustomFields:** add custom field models and mapping by type field definitions ([146ee40](https://github.com/sphereio/commercetools-php-sdk/commit/146ee40)) closes [#119](https://github.com/sphereio/commercetools-php-sdk/issues/119)
* **Message:** add specific message objects ([353b5ab](https://github.com/sphereio/commercetools-php-sdk/commit/353b5ab)) closes [#128](https://github.com/sphereio/commercetools-php-sdk/issues/128)
* **Orders:** add cart field to order ([922d812](https://github.com/sphereio/commercetools-php-sdk/commit/922d812)), closes [#132](https://github.com/sphereio/commercetools-php-sdk/issues/132) [#131](https://github.com/sphereio/commercetools-php-sdk/issues/131)
* **ProductSearch:** add reference expansion to product search request ([c003de6](https://github.com/sphereio/commercetools-php-sdk/commit/c003de6)), closes [#144](https://github.com/sphereio/commercetools-php-sdk/issues/144)
* **ProductVariant:** add helper methods to get variant by id ([f2ff1d4](https://github.com/sphereio/commercetools-php-sdk/commit/f2ff1d4))
* **Products:** add getBySku method ([ab9a0b9](https://github.com/sphereio/commercetools-php-sdk/commit/ab9a0b9))
* **Products:** add support to set EnumType and LocalizedEnumType attributes by key ([df88267](https://github.com/sphereio/commercetools-php-sdk/commit/df88267))
* **Products:** add support to set EnumType and LocalizedEnumType attributes by key in all variants ([e07cad6](https://github.com/sphereio/commercetools-php-sdk/commit/e07cad6))
* **QueryRequest:** add page request interface ([ecc5666](https://github.com/sphereio/commercetools-php-sdk/commit/ecc5666))
* **QueryRequest:** add sort and query request interfaces ([d19c127](https://github.com/sphereio/commercetools-php-sdk/commit/d19c127))
* **QueryRequest:** add with total request interface ([c1059ee](https://github.com/sphereio/commercetools-php-sdk/commit/c1059ee))
* **RedisCacheAdapter:** unify life time ([7b73d30](https://github.com/sphereio/commercetools-php-sdk/commit/7b73d30))
* **Reviews:** add review delete request ([2c6493e](https://github.com/sphereio/commercetools-php-sdk/commit/2c6493e)), closes [#134](https://github.com/sphereio/commercetools-php-sdk/issues/134)
* **ShippingMethod:** add getByName and getById to ShippingMethodCollection ([2de7668](https://github.com/sphereio/commercetools-php-sdk/commit/2de7668))
* **UpdateActions:** add limit to update actions ([3f728a5](https://github.com/sphereio/commercetools-php-sdk/commit/3f728a5))
* **CategoryCollection:** add getByParent and getRoots to CategoryCollection ([ece9d87](https://github.com/sphereio/commercetools-php-sdk/commit/ece9d87))
* **LocalizedString:** add support for locales to LocalizedString ([ea5e1c6](https://github.com/sphereio/commercetools-php-sdk/commit/ea5e1c6))
* **Image:** return empty thumb image url if no url is set ([a4be01b](https://github.com/sphereio/commercetools-php-sdk/commit/a4be01b))


### BREAKING CHANGES

* comments endpoint has been removed from the API

  All models and request objects have been removed from the SDK


<a name"1.0.0-RC2"></a>
# 1.0.0-RC2 (2015-08-03)


### Bug Fixes

* **ProductVariantDraft:** add images definition ([971cfbf4](https://github.com/sphereio/commercetools-php-sdk/commit/971cfbf4), closes [#135](https://github.com/sphereio/commercetools-php-sdk/issues/135))


### Breaking Changes

* SphereException and SphereServiceException have been renamed to ApiException and ApiServiceException

  Before
  ```
  try {
    ...
  } catch(SphereException $e) {
  }
  ```

  After:

  ```
  try {
    ...
  } catch(ApiException $e) {
  }
  ```

 ([813a6cb7](https://github.com/sphereio/commercetools-php-sdk/commit/813a6cb7))
* Namespace Sphere has been renamed to Commercetools

  Namespace and Use statements and fully qualified class names have to be adjusted. E.g.

  Before
  ```
  use Sphere\Core\Client;

  $class = '\Sphere\Core\Client';
  ```

  After:

  ```
  use Commercetools\Core\Client;

  $class = '\Commercetools\Core\Client';
  ```

 ([4bc9575f](https://github.com/sphereio/commercetools-php-sdk/commit/4bc9575f))


<a name"1.0.0-RC1"></a>
# 1.0.0-RC1 (2015-07-27)


### Bug Fixes

* **CustomerCreateRequest:** set correct return object class ([d1c100c9](https://github.com/sphereio/sphere-php-sdk/commit/d1c100c9), closes [#109](https://github.com/sphereio/sphere-php-sdk/issues/109))
* **Requests:** fix the usage of relative path by requests ([e32d0150](https://github.com/sphereio/sphere-php-sdk/commit/e32d0150))
* **Order:** set correct return type for order discountCodes ([5bbf4f14](https://github.com/sphereio/sphere-php-sdk/commit/5bbf4f14))


### Features

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


### Breaking Changes

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

# 1.0.0-beta.2 (Milestone 3)
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

# 1.0.0-beta.1 (Milestone 2)
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

# 1.0.0 Milestone 1
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

# 1.0.0 Milestone 0
 * initial commit
