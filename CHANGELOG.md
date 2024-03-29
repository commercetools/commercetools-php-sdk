# [2.22.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.21.0...v2.22.0) (2022-09-15)

### Features
* **composer:** update announcement of deprecation


# [2.21.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.20.0...v2.21.0) (2022-07-04)

### Features
* **docs:** update naming to match new branding initiative


# [2.20.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.19.0...v2.20.0) (2022-04-20)

### Features
* **Customer:** support authentication mode


# [2.19.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.18.0...v2.19.0) (2022-04-04)


### Bug Fixes

* **Customer:** made password field as optional field ([bf4d5a0](https://github.com/commercetools/commercetools-php-sdk/commit/bf4d5a0f57ecbba2a1268c452df11cf0606419d0))
* **Project:** fix optional flag for SearchIndexingConfigurationValues ([710019e](https://github.com/commercetools/commercetools-php-sdk/commit/710019e5980c87a676ec501928a8f8712c698d3b))


### Features

* **ApiClient:** add property for token validity ([0b43652](https://github.com/commercetools/commercetools-php-sdk/commit/0b43652c07df82d0d71827ba5b655aab0d1a2038))
* **ApiClient:** support shipping matching location adding sort ([d073700](https://github.com/commercetools/commercetools-php-sdk/commit/d07370061cd5fb54ded9cdc16175a11fd2204668))
* **Order:** support order payment added message ([28e0f92](https://github.com/commercetools/commercetools-php-sdk/commit/28e0f9234767effebf6a1c73565082068681e62f))
* **ProductSelection:** product selection extended with custom fields ([ff839ae](https://github.com/commercetools/commercetools-php-sdk/commit/ff839aeb96f27041e43b6b4d782cd70c93049137))
* **Store:** add missing update action ([2283fca](https://github.com/commercetools/commercetools-php-sdk/commit/2283fca23bcaf64cd20510f908f07239b3eea0bc))


# [2.18.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.17.0...v2.18.0) (2022-02-23)


### Bug Fixes

* **Models** added optional flag to field definitions of all models


### Features

* **Order:** add update actions to set the delivery in the custom fields for order and order edit ([083b4d8](https://github.com/commercetools/commercetools-php-sdk/commit/083b4d8877a49fecffe6171779068be36c176bf1))
* **ProductSelection:** new feature about product selection ([1d7b7f5](https://github.com/commercetools/commercetools-php-sdk/commit/1d7b7f5134c9037d585efc079c868bce8956abcc))

## [2.17.1-beta.1](https://github.com/commercetools/commercetools-php-sdk/compare/v2.17.0...v2.17.1-beta.1) (2022-02-23)

### Bug Fixes

* **JsonObject** fields are marked optional by default

# [2.17.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.16.0...v2.17.0) (2022-02-07)


### Features

* **Cart:** add key in Cart ([d3f24c4](https://github.com/commercetools/commercetools-php-sdk/commit/d3f24c4b419d363fbcea10cb7f44903025d1c5c9))
* **Cart:** add new field productkey ([ccd77b8](https://github.com/commercetools/commercetools-php-sdk/commit/ccd77b88d03f77e117521db6f9ce8ee78c740cfb))
* **Cart:** add test for replicate cart in store ([ec6390d](https://github.com/commercetools/commercetools-php-sdk/commit/ec6390d3235ebf8df9a7b57fd8e80638918e59c5))
* **Cart:** introduce more small features ([ba45fc5](https://github.com/commercetools/commercetools-php-sdk/commit/ba45fc54d3df1e5e39f296ff37866663d02442bc))
* **Cart:** support new update action setLineItemSupplyChannel ([87887cb](https://github.com/commercetools/commercetools-php-sdk/commit/87887cb1e05bdc769ae1a652f7d014ee479b98ea))
* **Customer:** add anonymousCart field ([4c45b41](https://github.com/commercetools/commercetools-php-sdk/commit/4c45b419573de216e34cb11b251364224b1d8f9c))
* **Delivery:** add field param ([c7ad278](https://github.com/commercetools/commercetools-php-sdk/commit/c7ad278fc2dba0ac513fdbcc3a6166ef86463c85))
* **Error:** add querytimeout error ([ec13853](https://github.com/commercetools/commercetools-php-sdk/commit/ec1385355be85bd9901215bd0515d9de04d70f87))
* **Error:** add querytimeout error ([153cc0b](https://github.com/commercetools/commercetools-php-sdk/commit/153cc0bdd3eee9d0adff330aeefb176f4a6c0e7d))
* **Head:** support Head method for products ([6a02a6b](https://github.com/commercetools/commercetools-php-sdk/commit/6a02a6be34237f46dd2424750f6e08941fd1e06e))
* **Message:** add field in InventoryEntryQuantitySetMessage ([7008f32](https://github.com/commercetools/commercetools-php-sdk/commit/7008f32ae9b83c8c50b2378a59a3d68ff3f9d873))
* **Message:** add new class as useProvidedIdentifiers for ContainerAndKey ([3d332fd](https://github.com/commercetools/commercetools-php-sdk/commit/3d332fd5dff35396920a67a7f6c3fb8ea5a76cb9))
* **Message:** add new message for products ([1e6e5ad](https://github.com/commercetools/commercetools-php-sdk/commit/1e6e5add27a4018b7469e586c518cba21f627680))
* **Message:** support oldState to OrderStateTransitionMessage and support store messages ([b56c7ed](https://github.com/commercetools/commercetools-php-sdk/commit/b56c7ed830661a7d6b81818f55926d8100576013))
* **Order:** support new update actions setReturnItemCustom as for order as for order edit ([d2e3879](https://github.com/commercetools/commercetools-php-sdk/commit/d2e38793890fc018908280c2d63537b50bfdbca9))
* **Order:** support setReturnInfoAction and related message ([b34aa6b](https://github.com/commercetools/commercetools-php-sdk/commit/b34aa6bfef43a311d64419b015b6d5ff54764941))
* **Order:** support update actions for Order and Order Edit to SetParcelCustom ([0124793](https://github.com/commercetools/commercetools-php-sdk/commit/0124793e950f793346bcdca7b238d2ca63c555c6))
* **Project:** add new actions and add customer message ([e97e521](https://github.com/commercetools/commercetools-php-sdk/commit/e97e521be1d8739f0291f5246441f02fe4f68fe4))
* **Project:** fix failed test ([b8357d0](https://github.com/commercetools/commercetools-php-sdk/commit/b8357d02643e980ddab735eb0bb2050b1117e408))
* **ShipingMethod:** add custom field and related action in shipping method ([5a9a3f9](https://github.com/commercetools/commercetools-php-sdk/commit/5a9a3f972781f25a744b599462834cc83ef603b8))
* **ShippingMethod:** support localizedName and related action ([50dbb24](https://github.com/commercetools/commercetools-php-sdk/commit/50dbb24e08d2553fbd09b73065e36c89b5c4ddd8))
* **UserAgent:** modify user agent ([aa7f055](https://github.com/commercetools/commercetools-php-sdk/commit/aa7f05537bfecd792d2feeb6cbb41d06991c010f))



# [2.16.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.15.0...v2.16.0) (2021-08-02)


### Features

* **Channel:** support set address custom update actions for channel and customers([371b47d](https://github.com/commercetools/commercetools-php-sdk/commit/371b47d773bac984afada00fe2c8f793540228d3))


# [2.15.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.14.0...v2.15.0) (2021-05-07)

### Features

* **Shopping List:** support store for shopping lists ([8808ed1](https://github.com/commercetools/commercetools-php-sdk/commit/8808ed1e36ffc0094372395bc9cd523ba2fcda22))


# [2.14.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.13.0...v2.14.0) (2021-03-02)

### Features

* **Store** support Custom fields for stores
* **Cart** support cart replicate for stores

### Bug Fixes

* **ErrorResponse:** add getter for inner exception ([96413a7](https://github.com/commercetools/commercetools-php-sdk/commit/96413a76ffa90954cbf2f496f4c71e3634c01740)), closes [#601](https://github.com/commercetools/commercetools-php-sdk/issues/601)


# [2.13.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.12.1...v2.13.0) (2021-01-11)


### Features

* **Store:** support distribution and supply channel for update actions ([6cfdcb7](https://github.com/commercetools/commercetools-php-sdk/commit/6cfdcb7f99d558ba859069a55ea21f86d6f9494e))



## [2.12.1](https://github.com/commercetools/commercetools-php-sdk/compare/v2.12.0...v2.12.1) (2020-10-30)


### Bug Fixes

* **Client:** fix adapter factory to correctly identify the GuzzleAdapter ([221b690](https://github.com/commercetools/commercetools-php-sdk/commit/221b69018badbc26a49dcbcb619509c2daccb0b9))



# [2.12.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.11.1...v2.12.0) (2020-10-12)


### Features

* **Error:** add response body to exception message for BadRequest ([a0511ab](https://github.com/commercetools/commercetools-php-sdk/commit/a0511ab887b3636063cac0dc39eb09578fa04d05))
* **Order:** migrate the first tests and create the fixture ([39b16f2](https://github.com/commercetools/commercetools-php-sdk/commit/39b16f2c3910bf7fe09d88cedbe9afcdfef8ec96))
* **Project:** support country taxRate fallback ([35001b8](https://github.com/commercetools/commercetools-php-sdk/commit/35001b8663e98e0494b34ee527efb4e325de27bd))
* **Project:** support language used in stores error ([d170ea6](https://github.com/commercetools/commercetools-php-sdk/commit/d170ea66ee37416e402802a7d766d86dd901a591)), closes [#578](https://github.com/commercetools/commercetools-php-sdk/issues/578)



# [2.11.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.10.0...v2.11.0) (2020-05-05)


### Features

* **Error:** add helper methods to retrieve errors from exceptions ([fd09c89](https://github.com/commercetools/commercetools-php-sdk/commit/fd09c89ce1570913fdf2426b11b0309afbb42171))
* **Error:** improve message for unknown ApiException ([24a91ad](https://github.com/commercetools/commercetools-php-sdk/commit/24a91adef569491c77ab2d76a584909963ac48ab))
* **Message:** support InventoryEntryQuantitySet message ([043aebe](https://github.com/commercetools/commercetools-php-sdk/commit/043aebe7dba96b825efcd720f936e50d276a349d))
* **Search:** add helper method to retrieve facets from search response ([2a24040](https://github.com/commercetools/commercetools-php-sdk/commit/2a24040b498cefd8cbc62178b68654869ffb6f5b))



# [2.10.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.9.0...v2.10.0) (2020-04-02)


### Bug Fixes

* **Query:** fix query predicate variables to be forward compatible ([bb50caa](https://github.com/commercetools/commercetools-php-sdk/commit/bb50caa8e6166117ebffb6b27bc56f3f1fae6ff1))


### Features

* **ApiClient:** oauth handler maps authentication errors to ApiException ([7a2e887](https://github.com/commercetools/commercetools-php-sdk/commit/7a2e887b905427924cc61c27a27cf4ec34244f40))
* **Config:** remove legacy hostnames ([27f3769](https://github.com/commercetools/commercetools-php-sdk/commit/27f37690caf1790aee4fe05445be89fc7ae847ff)), closes [#537](https://github.com/commercetools/commercetools-php-sdk/issues/537)
* **CustomerAddress:** add addressKey to actions and add one test ([04b453a](https://github.com/commercetools/commercetools-php-sdk/commit/04b453a4ce868eab7ac152e9c782f708da2cf3f4))
* **CustomerStore:** add set add remove action for store in customer and add tests ([cedb0b0](https://github.com/commercetools/commercetools-php-sdk/commit/cedb0b017a9daf655fdfba031174992558858650))
* **InventoryEntry:** add message for InventoryEntryCreated ([5c7319f](https://github.com/commercetools/commercetools-php-sdk/commit/5c7319fa67e7b176879e8f650e0a0ab7dda5f670))
* **OrderStore:** add setStore action and message ([b375bfe](https://github.com/commercetools/commercetools-php-sdk/commit/b375bfe22eed819ebc4ed52e9ecbd62e79dd7ea9))
* **ProductFixture:** update all methods relative to Cart with Published Product ([7c3fb2a](https://github.com/commercetools/commercetools-php-sdk/commit/7c3fb2a686cb6687b1da094248c64a6a3ea4d8fc))
* **ShippingMethods:** add localized description to shippingMethods ([747179d](https://github.com/commercetools/commercetools-php-sdk/commit/747179dc1d1e1832185fbc96600eac0c731126a2))
* **Store:** add Languages field to store ([b74172f](https://github.com/commercetools/commercetools-php-sdk/commit/b74172f15d12e1c47dc91e8e615d72953505e312))



# [2.9.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.8.0...v2.9.0) (2019-12-02)


### Bug Fixes

* **Cart:** fix serialization of cart draft ([024b8fd](https://github.com/commercetools/commercetools-php-sdk/commit/024b8fd))
* **OAuth:** fix oauth refresh token URL ([0bf801d](https://github.com/commercetools/commercetools-php-sdk/commit/0bf801d))


### Features

* **ApiClient:** add deleteAt to feldDefinition method ([d2b6b35](https://github.com/commercetools/commercetools-php-sdk/commit/d2b6b35))
* **ApiClientDraft:** add deleteDaysAfterCreation in fieldDefinitions ([4ee7f07](https://github.com/commercetools/commercetools-php-sdk/commit/4ee7f07))
* **ClientFactory:** add option to inject middleware to HttpClients ([734fe63](https://github.com/commercetools/commercetools-php-sdk/commit/734fe63))
* **ClientFactory:** create HttpClient with CTP client compatible request signature ([3a55d24](https://github.com/commercetools/commercetools-php-sdk/commit/3a55d24))
* **Customer:** support stores for customer ([5eee954](https://github.com/commercetools/commercetools-php-sdk/commit/5eee954))
* **Draft:** add factory methods in draft classes for ApiClient and Asset and Cart ([bc0f616](https://github.com/commercetools/commercetools-php-sdk/commit/bc0f616))
* **ImportOrder:** support store for order import ([175953c](https://github.com/commercetools/commercetools-php-sdk/commit/175953c)), closes [#499](https://github.com/commercetools/commercetools-php-sdk/issues/499)
* **InStoreRequest:** add request to InStoreRequests to add new shipping method endpoint ([ee7620f](https://github.com/commercetools/commercetools-php-sdk/commit/ee7620f))
* **Me:** support me/shopping-lists endpoint ([fc52e82](https://github.com/commercetools/commercetools-php-sdk/commit/fc52e82))
* **Message:** add messages ProductAddedToCategory and ProductRemovedFromCategory ([673b4cf](https://github.com/commercetools/commercetools-php-sdk/commit/673b4cf))
* **Order:** add refusedGift field ([7532e38](https://github.com/commercetools/commercetools-php-sdk/commit/7532e38))
* **Product:** add discounted field to PriceDraft ([b3c44fe](https://github.com/commercetools/commercetools-php-sdk/commit/b3c44fe))
* **Query:** add support for parametrized queries ([b3bc4ad](https://github.com/commercetools/commercetools-php-sdk/commit/b3bc4ad)), closes [#505](https://github.com/commercetools/commercetools-php-sdk/issues/505)



# [2.8.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.7.0...v2.8.0) (2019-06-06)


### Features

* **CartDiscount:** support key attribute ([641a8e0](https://github.com/commercetools/commercetools-php-sdk/commit/641a8e0))
* **Client:** add client factory for direct usage of guzzle http client ([40a0bd0](https://github.com/commercetools/commercetools-php-sdk/commit/40a0bd0))
* **ClientLogging:** add CreatedBy and LastModifieldBy fields ([b64d199](https://github.com/commercetools/commercetools-php-sdk/commit/b64d199))
* **ClientLogging:** support setting X-External-User-ID header ([bc863c7](https://github.com/commercetools/commercetools-php-sdk/commit/bc863c7))
* **Extension:** support timeoutInMs ([92fcc1b](https://github.com/commercetools/commercetools-php-sdk/commit/92fcc1b))
* **InStore:** allow only valid in-store endpoints ([b263181](https://github.com/commercetools/commercetools-php-sdk/commit/b263181))
* **Me:** add MeCartDeleteRequest ([b42424a](https://github.com/commercetools/commercetools-php-sdk/commit/b42424a))
* **ProductDiscount:** support key attribute ([a06a00d](https://github.com/commercetools/commercetools-php-sdk/commit/a06a00d))
* **Project:** support external OAuth ([0522fe0](https://github.com/commercetools/commercetools-php-sdk/commit/0522fe0)), closes [#474](https://github.com/commercetools/commercetools-php-sdk/issues/474)
* **Response:** add method to extract guzzle promise ([bb75909](https://github.com/commercetools/commercetools-php-sdk/commit/bb75909))
* **Store:** support in-store requests ([526d0ba](https://github.com/commercetools/commercetools-php-sdk/commit/526d0ba))
* **Store:** support Store model ([a166426](https://github.com/commercetools/commercetools-php-sdk/commit/a166426))
* **Type:** add new type update actions ([0e5774c](https://github.com/commercetools/commercetools-php-sdk/commit/0e5774c)), closes [#489](https://github.com/commercetools/commercetools-php-sdk/issues/489)



<a name="2.7.0"></a>
# [2.7.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.6.0...v2.7.0) (2019-03-20)


### Bug Fixes

* **GraphQL:** fix GraphQL requests without variables ([fa9d376](https://github.com/commercetools/commercetools-php-sdk/commit/fa9d376))
* **LineItemImportDraft:** add missing field distributionChannel ([52d2ff0](https://github.com/commercetools/commercetools-php-sdk/commit/52d2ff0))


### Features

* **Discounts:** add setValidFromAndUntil action ([c226e1f](https://github.com/commercetools/commercetools-php-sdk/commit/c226e1f))
* **Error:** add error codes for BadRequest ([9012d5d](https://github.com/commercetools/commercetools-php-sdk/commit/9012d5d))
* **ExternalTaxRateDraft:** add field includedInPrice ([2771f2d](https://github.com/commercetools/commercetools-php-sdk/commit/2771f2d)), closes [#451](https://github.com/commercetools/commercetools-php-sdk/issues/451)
* **Message:** add new messages for ProductPriceDiscounts ([fc876f7](https://github.com/commercetools/commercetools-php-sdk/commit/fc876f7)), closes [#445](https://github.com/commercetools/commercetools-php-sdk/issues/445)
* **Message:** add OrderDeleted Message ([22ab652](https://github.com/commercetools/commercetools-php-sdk/commit/22ab652))
* **Messages:** set MessagesConfiguration at Project ([5389c23](https://github.com/commercetools/commercetools-php-sdk/commit/5389c23)), closes [#443](https://github.com/commercetools/commercetools-php-sdk/issues/443)
* **Order:** support setCustomerId ([756811d](https://github.com/commercetools/commercetools-php-sdk/commit/756811d))
* **PasswordResetToken:** support ttlMinutes for token ([ebe6d77](https://github.com/commercetools/commercetools-php-sdk/commit/ebe6d77))
* **ProductAddVariantAction:** support field assets ([ce591e8](https://github.com/commercetools/commercetools-php-sdk/commit/ce591e8))
* **ProductType:** support changeAttributeOrderByName action ([dd52af8](https://github.com/commercetools/commercetools-php-sdk/commit/dd52af8)), closes [#453](https://github.com/commercetools/commercetools-php-sdk/issues/453)
* **ShippingInfoImportDraft:** add ShippingInfoImportDraft representation ([bde4473](https://github.com/commercetools/commercetools-php-sdk/commit/bde4473)), closes [#449](https://github.com/commercetools/commercetools-php-sdk/issues/449)
* **ShippingMethod:** support Reference expansion ([bd745f7](https://github.com/commercetools/commercetools-php-sdk/commit/bd745f7))
* **Subscription:** add changeDestination update action ([b0fbb04](https://github.com/commercetools/commercetools-php-sdk/commit/b0fbb04)), closes [#437](https://github.com/commercetools/commercetools-php-sdk/issues/437)
* **Subscription:** add subscription status ([a2ff2e1](https://github.com/commercetools/commercetools-php-sdk/commit/a2ff2e1)), closes [#436](https://github.com/commercetools/commercetools-php-sdk/issues/436)
* **UserProvidedIdentifiers:** support UserProvidedIdentifiers at Messages & Subscriptions ([aeece56](https://github.com/commercetools/commercetools-php-sdk/commit/aeece56))
* **Zone:** support Key on shipping Zones ([d331cff](https://github.com/commercetools/commercetools-php-sdk/commit/d331cff)), closes [#448](https://github.com/commercetools/commercetools-php-sdk/issues/448)



<a name="2.6.0"></a>
# [2.6.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.5.1...v2.6.0) (2019-01-11)


### Bug Fixes

* **OrderEditResult:** fix data mapping ([08af3bd](https://github.com/commercetools/commercetools-php-sdk/commit/08af3bd))
* **OrderEditResult:** fix type property ([c84d649](https://github.com/commercetools/commercetools-php-sdk/commit/c84d649))
* **OrderEditUpdateByKey:** fix inheritance class & add test for dryRun ([7e0a465](https://github.com/commercetools/commercetools-php-sdk/commit/7e0a465))
* **OrderEdit:** fix StagedOrder structure & ActionBuilder ([6fd3c65](https://github.com/commercetools/commercetools-php-sdk/commit/6fd3c65))
* **RequestBuilder:** fix OrderEditApplyRequest ([252f319](https://github.com/commercetools/commercetools-php-sdk/commit/252f319))
* **SetCustomShippingMethodAction:** fix type of shippingRate property ([ce1afa4](https://github.com/commercetools/commercetools-php-sdk/commit/ce1afa4))
* **Subscription:** fix typo in SQS destination ([cbf1dae](https://github.com/commercetools/commercetools-php-sdk/commit/cbf1dae))
* **TLS Check:** update urls for TLS 1.2 check ([f006006](https://github.com/commercetools/commercetools-php-sdk/commit/f006006))


### Features

* **ApiClients:** add support for managing api clients ([93b62de](https://github.com/commercetools/commercetools-php-sdk/commit/93b62de))
* **Order:** add support for CustomLineItemReturnItem ([82ebfdf](https://github.com/commercetools/commercetools-php-sdk/commit/82ebfdf))
* **Payment:** support anonymousId ([4dd0e3e](https://github.com/commercetools/commercetools-php-sdk/commit/4dd0e3e))

<a name="2.5.1"></a>
## [2.5.1](https://github.com/commercetools/commercetools-php-sdk/compare/v2.5.0...v2.5.1) (2018-10-24)


### Bug Fixes

* **Money:** fix fraction digits type ([f870109](https://github.com/commercetools/commercetools-php-sdk/commit/f870109)), closes [#429](https://github.com/commercetools/commercetools-php-sdk/issues/429)



<a name="2.5.0"></a>
# [2.5.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.4.0...v2.5.0) (2018-08-16)


### Features

* **Cart:** support multiple shipping addresses ([20014da](https://github.com/commercetools/commercetools-php-sdk/commit/20014da))
* **Extension:** support API extensions  ([9ca58c8](https://github.com/commercetools/commercetools-php-sdk/commit/9ca58c8)), closes [#365](https://github.com/commercetools/commercetools-php-sdk/issues/365)
* **Money:** support high precision money ([95722b9](https://github.com/commercetools/commercetools-php-sdk/commit/95722b9)), closes [#410](https://github.com/commercetools/commercetools-php-sdk/issues/410)
* **Order:** support multiple shipping addresses ([d98c259](https://github.com/commercetools/commercetools-php-sdk/commit/d98c259))
* **OrderFromCart:** support state, orderState, shipmentState at OrderCreateFromCart ([5fd4375](https://github.com/commercetools/commercetools-php-sdk/commit/5fd4375)), closes [#412](https://github.com/commercetools/commercetools-php-sdk/issues/412) [#417](https://github.com/commercetools/commercetools-php-sdk/issues/417)
* **ProductDiscount:** add setValidFromAndUntil update action ([1e54656](https://github.com/commercetools/commercetools-php-sdk/commit/1e54656))
* **ProductDiscounts:** add endpoint for Matching ProductDiscount ([9258a62](https://github.com/commercetools/commercetools-php-sdk/commit/9258a62))
* **Request:** add GDPR dataErasure flag ([5d35ea1](https://github.com/commercetools/commercetools-php-sdk/commit/5d35ea1)), closes [#411](https://github.com/commercetools/commercetools-php-sdk/issues/411)
* **ShoppingList:** support AnonymousId on ShoppingList owner ([efd2565](https://github.com/commercetools/commercetools-php-sdk/commit/efd2565))
* **Subscription:** add Google Cloud PubSub destination ([585501a](https://github.com/commercetools/commercetools-php-sdk/commit/585501a)), closes [#418](https://github.com/commercetools/commercetools-php-sdk/issues/418)
* **Subscription:** add modifiedAt to change subscription payloads ([602303a](https://github.com/commercetools/commercetools-php-sdk/commit/602303a)), closes [#416](https://github.com/commercetools/commercetools-php-sdk/issues/416)
* **Subscription:** add payloadNotIncluded to message delivery ([60e207b](https://github.com/commercetools/commercetools-php-sdk/commit/60e207b)), closes [#413](https://github.com/commercetools/commercetools-php-sdk/issues/413)



<a name="2.4.0"></a>
# [2.4.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.3.0...v2.4.0) (2018-05-31)


### Bug Fixes

* **Guzzle5Adapter:** fix applying client options to guzzle5 http client ([e735afd](https://github.com/commercetools/commercetools-php-sdk/commit/e735afd))


### Features

* **Attribute:** enhance getting attribute by name from attributes collection ([5d6ef10](https://github.com/commercetools/commercetools-php-sdk/commit/5d6ef10))
* **Builder:** add request and update actions builder DSL ([3a55e6d](https://github.com/commercetools/commercetools-php-sdk/commit/3a55e6d))
* **Cart:** Support cart replication ([52d9448](https://github.com/commercetools/commercetools-php-sdk/commit/52d9448)), closes [#392](https://github.com/commercetools/commercetools-php-sdk/issues/392)
* **CartDiscount:** support MultiBuyDiscount on custom line items ([f53d0b5](https://github.com/commercetools/commercetools-php-sdk/commit/f53d0b5)), closes [#389](https://github.com/commercetools/commercetools-php-sdk/issues/389)
* **Message:** add customer messages ([2f8c91d](https://github.com/commercetools/commercetools-php-sdk/commit/2f8c91d)), closes [#391](https://github.com/commercetools/commercetools-php-sdk/issues/391)
* **OAuthManager:** add configuration options for internal HTTP client ([5746c4a](https://github.com/commercetools/commercetools-php-sdk/commit/5746c4a)), closes [#395](https://github.com/commercetools/commercetools-php-sdk/issues/395)
* **ProductType:** support product type changeAttributeName & changeEnumKey ([#397](https://github.com/commercetools/commercetools-php-sdk/issues/397)) ([8994315](https://github.com/commercetools/commercetools-php-sdk/commit/8994315)), closes [#393](https://github.com/commercetools/commercetools-php-sdk/issues/393)
* **ProductType:** support product type removeEnumValues update action ([2bf3e13](https://github.com/commercetools/commercetools-php-sdk/commit/2bf3e13)), closes [#388](https://github.com/commercetools/commercetools-php-sdk/issues/388)



<a name="2.3.0"></a>
# [2.3.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.2.1...v2.3.0) (2018-03-13)


### Bug Fixes

* **Context:** fix setting of uninitialized properties in context object ([adbb71f](https://github.com/commercetools/commercetools-php-sdk/commit/adbb71f)), closes [#379](https://github.com/commercetools/commercetools-php-sdk/issues/379)
* **Query:** fix undesired sort of query parameter sort ([f22bd65](https://github.com/commercetools/commercetools-php-sdk/commit/f22bd65)), closes [#386](https://github.com/commercetools/commercetools-php-sdk/issues/386)


### Features

* **CartDiscount:** support cart discount stacking mode ([64f18b8](https://github.com/commercetools/commercetools-php-sdk/commit/64f18b8)), closes [#354](https://github.com/commercetools/commercetools-php-sdk/issues/354)
* **CartDiscount:** support multi buy discounts ([5207c2b](https://github.com/commercetools/commercetools-php-sdk/commit/5207c2b)), closes [#353](https://github.com/commercetools/commercetools-php-sdk/issues/353)
* **Context:** add interface for CurrencyFormatter ([b35abff](https://github.com/commercetools/commercetools-php-sdk/commit/b35abff))
* **CustomObject:** add CustomObjectByIdGetRequest ([2194d3e](https://github.com/commercetools/commercetools-php-sdk/commit/2194d3e))
* **DiscountCode:** support custom fields for discount codes ([80aa86f](https://github.com/commercetools/commercetools-php-sdk/commit/80aa86f)), closes [#352](https://github.com/commercetools/commercetools-php-sdk/issues/352)
* **DiscountCode:** support validFrom and validUntil for discount codes ([523929a](https://github.com/commercetools/commercetools-php-sdk/commit/523929a)), closes [#367](https://github.com/commercetools/commercetools-php-sdk/issues/367)
* **DiscountCode:** support groups for discount codes ([53a8f05](https://github.com/commercetools/commercetools-php-sdk/commit/53a8f05)), closes [#362](https://github.com/commercetools/commercetools-php-sdk/issues/362)
* **Order:** support delivery update actions ([d033399](https://github.com/commercetools/commercetools-php-sdk/commit/d033399)), closes [#369](https://github.com/commercetools/commercetools-php-sdk/issues/369)
* **Order:** support get/update/delete order by orderNumber ([dc1a101](https://github.com/commercetools/commercetools-php-sdk/commit/dc1a101)), closes [#356](https://github.com/commercetools/commercetools-php-sdk/issues/356)
* **Order:** support parcel delivery items ([6f35c31](https://github.com/commercetools/commercetools-php-sdk/commit/6f35c31)), closes [#357](https://github.com/commercetools/commercetools-php-sdk/issues/357)
* **Cart:** support tax calculation mode ([2ef543b](https://github.com/commercetools/commercetools-php-sdk/commit/2ef543b)), closes [#376](https://github.com/commercetools/commercetools-php-sdk/issues/376)
* **Payment:** support get/update/delete payment by key ([da32ce6](https://github.com/commercetools/commercetools-php-sdk/commit/da32ce6)), closes [#349](https://github.com/commercetools/commercetools-php-sdk/issues/349)
* **State:** add constant for state role return ([b713135](https://github.com/commercetools/commercetools-php-sdk/commit/b713135)), closes [#363](https://github.com/commercetools/commercetools-php-sdk/issues/363)
* **Order:** support address for order deliveries ([8ef8dea](https://github.com/commercetools/commercetools-php-sdk/commit/8ef8dea)), closes [#366](https://github.com/commercetools/commercetools-php-sdk/issues/366)
* **Client:** support client instantiation with preconfigured bearer token ([d93a455](https://github.com/commercetools/commercetools-php-sdk/commit/d93a455)), closes [#359](https://github.com/commercetools/commercetools-php-sdk/issues/359)
* **CartDiscount:** support custom field for cart discounts ([a8325c1](https://github.com/commercetools/commercetools-php-sdk/commit/a8325c1)), closes [#373](https://github.com/commercetools/commercetools-php-sdk/issues/373)
* **CustomerGroup:** support custom field for customer groups ([23d1737](https://github.com/commercetools/commercetools-php-sdk/commit/23d1737)), closes [#360](https://github.com/commercetools/commercetools-php-sdk/issues/360)
* **Assets:** support key for assets ([a3c9ea0](https://github.com/commercetools/commercetools-php-sdk/commit/a3c9ea0)), closes [#371](https://github.com/commercetools/commercetools-php-sdk/issues/371)
* **Cart:** support origin for carts and orders ([37db8de](https://github.com/commercetools/commercetools-php-sdk/commit/37db8de)), closes [#361](https://github.com/commercetools/commercetools-php-sdk/issues/361)
* **Product:** support revertStagedVariantChanges ([18d0be2](https://github.com/commercetools/commercetools-php-sdk/commit/18d0be2)), closes [#372](https://github.com/commercetools/commercetools-php-sdk/issues/372)
* **ProductDiscount:** support validFrom and validUntil for product discounts ([c75e53c](https://github.com/commercetools/commercetools-php-sdk/commit/c75e53c)), closes [#368](https://github.com/commercetools/commercetools-php-sdk/issues/368)
* **ProductType:** support changeAttributeConstraint update action ([52932d8](https://github.com/commercetools/commercetools-php-sdk/commit/52932d8)), closes [#370](https://github.com/commercetools/commercetools-php-sdk/issues/370)
* **ShippingMethod:** support setPredicate on shipping methods ([ec2fce5](https://github.com/commercetools/commercetools-php-sdk/commit/ec2fce5)), closes [#375](https://github.com/commercetools/commercetools-php-sdk/issues/375)
* **Product:** support staged flag for product meta update actions ([b60aab0](https://github.com/commercetools/commercetools-php-sdk/commit/b60aab0)), closes [#358](https://github.com/commercetools/commercetools-php-sdk/issues/358)
* **ShippingMethod:** support shipping rate tiers ([#384](https://github.com/commercetools/commercetools-php-sdk/issues/384)) ([7611315](https://github.com/commercetools/commercetools-php-sdk/commit/7611315)), closes [#355](https://github.com/commercetools/commercetools-php-sdk/issues/355)
* **ShoppingList:** support add line item by SKU ([7172e1c](https://github.com/commercetools/commercetools-php-sdk/commit/7172e1c)), closes [#374](https://github.com/commercetools/commercetools-php-sdk/issues/374)
* **Customer:** support updateProductData of cart on customer login ([555ccb3](https://github.com/commercetools/commercetools-php-sdk/commit/555ccb3)), closes [#377](https://github.com/commercetools/commercetools-php-sdk/issues/377)



<a name="2.2.1"></a>
## [2.2.1](https://github.com/commercetools/commercetools-php-sdk/compare/v2.2.0...v2.2.1) (2017-10-06)

* Update cache adapter dependencies

<a name="2.2.0"></a>
# [2.2.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.1.0...v2.2.0) (2017-09-27)


### Bug Fixes

* **Me:** fix MeUpdateRequest constructor ([e96a2d1](https://github.com/commercetools/commercetools-php-sdk/commit/e96a2d1))
* **Message:** fix object hierarchy for PaymentTransactionStateChanged message ([b4ec4a2](https://github.com/commercetools/commercetools-php-sdk/commit/b4ec4a2))
* **StateTransitionMessage:** fix type of state in StateTransitionMessage ([2bb1efd](https://github.com/commercetools/commercetools-php-sdk/commit/2bb1efd))


### Features

* **Cart:** support add line item by sky ([3b81973](https://github.com/commercetools/commercetools-php-sdk/commit/3b81973)), closes [#341](https://github.com/commercetools/commercetools-php-sdk/issues/341)
* **Cart:** support external tax amount ([95e5547](https://github.com/commercetools/commercetools-php-sdk/commit/95e5547)), closes [#347](https://github.com/commercetools/commercetools-php-sdk/issues/347)
* **Cart:** support setAnonymousId ([1a1e472](https://github.com/commercetools/commercetools-php-sdk/commit/1a1e472)), closes [#338](https://github.com/commercetools/commercetools-php-sdk/issues/338)
* **Cart:** support setCustomerGroup update action ([80c72ec](https://github.com/commercetools/commercetools-php-sdk/commit/80c72ec)), closes [#343](https://github.com/commercetools/commercetools-php-sdk/issues/343)
* **Client:** add configuration options for guzzle ([18dbd00](https://github.com/commercetools/commercetools-php-sdk/commit/18dbd00)), closes [#345](https://github.com/commercetools/commercetools-php-sdk/issues/345)
* **Client:** support creation of correlation id at client side ([124c004](https://github.com/commercetools/commercetools-php-sdk/commit/124c004)), closes [#328](https://github.com/commercetools/commercetools-php-sdk/issues/328)
* **CustomField:** add type safe getter for field in field container ([732f861](https://github.com/commercetools/commercetools-php-sdk/commit/732f861))
* **Customer:** support setKey for customers ([211573d](https://github.com/commercetools/commercetools-php-sdk/commit/211573d)), closes [#342](https://github.com/commercetools/commercetools-php-sdk/issues/342)
* **CustomerGroup:** support field `key` functionality ([57e803c](https://github.com/commercetools/commercetools-php-sdk/commit/57e803c)), closes [#330](https://github.com/commercetools/commercetools-php-sdk/issues/330)
* **Message:** add ProductVariantDeleted, ProductDeleted and ProductRevertedStagedChanges message ([f7291ae](https://github.com/commercetools/commercetools-php-sdk/commit/f7291ae)), closes [#332](https://github.com/commercetools/commercetools-php-sdk/issues/332)
* **Product:** add typed getter for product attribute value ([34afcdd](https://github.com/commercetools/commercetools-php-sdk/commit/34afcdd))
* **Product:** support scope for product publish ([9d0b5aa](https://github.com/commercetools/commercetools-php-sdk/commit/9d0b5aa)), closes [#340](https://github.com/commercetools/commercetools-php-sdk/issues/340)
* **Project:** support change of project settings ([347ecb6](https://github.com/commercetools/commercetools-php-sdk/commit/347ecb6)), closes [#350](https://github.com/commercetools/commercetools-php-sdk/issues/350)
* **ShippingMethod:** add support for shipping method predicate ([19ea63e](https://github.com/commercetools/commercetools-php-sdk/commit/19ea63e)), closes [#348](https://github.com/commercetools/commercetools-php-sdk/issues/348)
* **ShippingMethod:** support shipping method by key functionality ([3ba9596](https://github.com/commercetools/commercetools-php-sdk/commit/3ba9596)), closes [#329](https://github.com/commercetools/commercetools-php-sdk/issues/329)
* **Subscription:** support azure service bus destination ([58ad977](https://github.com/commercetools/commercetools-php-sdk/commit/58ad977)), closes [#331](https://github.com/commercetools/commercetools-php-sdk/issues/331)
* **TaxCategory:** support setKey for tax categories ([6c41b97](https://github.com/commercetools/commercetools-php-sdk/commit/6c41b97)), closes [#339](https://github.com/commercetools/commercetools-php-sdk/issues/339)



<a name="2.1.0"></a>
# [2.1.0](https://github.com/commercetools/commercetools-php-sdk/compare/v2.0.0...v2.1.0) (2017-07-06)


### Features

* **Cart:** support external price for line items ([3a9d972](https://github.com/commercetools/commercetools-php-sdk/commit/3a9d972)), closes [#322](https://github.com/commercetools/commercetools-php-sdk/issues/322)
* **CartDiscount:** support free gift line item ([ad58116](https://github.com/commercetools/commercetools-php-sdk/commit/ad58116)), closes [#325](https://github.com/commercetools/commercetools-php-sdk/issues/325)
* **Category:** support category key functionality ([d2b63dd](https://github.com/commercetools/commercetools-php-sdk/commit/d2b63dd)), closes [#326](https://github.com/commercetools/commercetools-php-sdk/issues/326)
* **Customer:** add get customer by email token request ([8de3b30](https://github.com/commercetools/commercetools-php-sdk/commit/8de3b30))
* **Customer:** add salutation to customer ([c1c65fd](https://github.com/commercetools/commercetools-php-sdk/commit/c1c65fd)), closes [#324](https://github.com/commercetools/commercetools-php-sdk/issues/324)
* **Messages:** add OrderPaymentStateChanged message ([6afb611](https://github.com/commercetools/commercetools-php-sdk/commit/6afb611)), closes [#312](https://github.com/commercetools/commercetools-php-sdk/issues/312)
* **Messages:** add PaymentStatusInterfaceCodeSet message ([c5e0531](https://github.com/commercetools/commercetools-php-sdk/commit/c5e0531)), closes [#313](https://github.com/commercetools/commercetools-php-sdk/issues/313)
* **Messages:** add ProductImageAdded message ([0e14d97](https://github.com/commercetools/commercetools-php-sdk/commit/0e14d97)), closes [#314](https://github.com/commercetools/commercetools-php-sdk/issues/314)
* **Payment:** support key for payments ([1f40cef](https://github.com/commercetools/commercetools-php-sdk/commit/1f40cef)), closes [#315](https://github.com/commercetools/commercetools-php-sdk/issues/315)
* **ProductType:** add change inputHint update action ([af666f6](https://github.com/commercetools/commercetools-php-sdk/commit/af666f6)), closes [#323](https://github.com/commercetools/commercetools-php-sdk/issues/323)
* **ShippingMethod:** add isMatching flag to shipping rates ([c6b4328](https://github.com/commercetools/commercetools-php-sdk/commit/c6b4328))


<a name="2.0.0"></a>
# [2.0.0](https://github.com/commercetools/commercetools-php-sdk/compare/v1.7.0...v2.0.0) (2017-05-31)


### Bug Fixes

* **AssetDraft:** correct type for custom field object ([abc0afd](https://github.com/commercetools/commercetools-php-sdk/commit/abc0afd))
* **Collection:** fix iterator for unset elements of collections (#307) ([5687380](https://github.com/commercetools/commercetools-php-sdk/commit/5687380)), closes [#307](https://github.com/issues/307)
* **Customer:** fix create email token request with TTL ([8367ef6](https://github.com/commercetools/commercetools-php-sdk/commit/8367ef6))
* **ImageUpload:** fix product image upload ([445b2f4](https://github.com/commercetools/commercetools-php-sdk/commit/445b2f4))
* **ProductSuggest:** fix suggestion parameters ([d9652df](https://github.com/commercetools/commercetools-php-sdk/commit/d9652df)), closes [#310](https://github.com/commercetools/commercetools-php-sdk/issues/310)

### Code Refactoring

* **OAuth:** change scope of getCacheAdapter method ([c6b27ec](https://github.com/commercetools/commercetools-php-sdk/commit/c6b27ec))
* **ProductSearch:** disable markMatchingVariants by default ([41711a8](https://github.com/commercetools/commercetools-php-sdk/commit/41711a8))

### Features

* **Product:** support tiered pricing ([93802cd](https://github.com/commercetools/commercetools-php-sdk/commit/93802cd)), closes [#303](https://github.com/commercetools/commercetools-php-sdk/issues/303)
* **Cache:** support PSR-16 cache implementations ([c3ceac7](https://github.com/commercetools/commercetools-php-sdk/commit/c3ceac7)), closes [#297](https://github.com/commercetools/commercetools-php-sdk/issues/297)
* **Client:** add logLevel configuration option ([8aa457a](https://github.com/commercetools/commercetools-php-sdk/commit/8aa457a)), closes [#300](https://github.com/commercetools/commercetools-php-sdk/issues/300)
* **Client:** add possibility for additional headers when executing request ([74c5a15](https://github.com/commercetools/commercetools-php-sdk/commit/74c5a15))
* **ShoppingList:** add SetDeleteDaysAfterLastModificationAction ([d31b839](https://github.com/commercetools/commercetools-php-sdk/commit/d31b839))
* **Subscription:** add getter for message to message subscription payload ([daa2558](https://github.com/commercetools/commercetools-php-sdk/commit/daa2558)), closes [#308](https://github.com/commercetools/commercetools-php-sdk/issues/308)


### BREAKING CHANGES

* PHP minimum version is now 5.6
* guzzle/log-subscriber has been removed as a dependency
* AssetDraft: AssetDraft requires CustomFieldObjectDraft instead of CustomFieldObject

  Before:

  ```
  $assetDraft = AssetDraft::of()->setCustom(CustomFieldObject::of());
  ```

  After:

  ```
  $assetDraft = AssetDraft::of()->setCustom(CustomFieldObjectDraft::of());
  ```
* OAuth: Manager::getCacheAdapter() method scope has been changed from public to protected
* ProductSearch: markMatchingVariants has been disabled by default

  For performance reasons the markMatchingVariants flag has been disabled by default. In order to use markMatchingVariants feature please enable it explicit.

  Before:
  ```
  $request = ProductProjectionSearchRequest::of();
  ```

  After:
  ```
  $request = ProductProjectionSearchRequest::of()->markMatchingVariants(true);
  ```
* Token caching is now using [PSR-6](https://packagist.org/providers/psr/cache-implementation) or [PSR-16](https://packagist.org/providers/psr/simple-cache-implementation) cache adapters only.
  Removed classes:
  - AbstractCacheAdapter
  - ApcCacheAdapter
  - ApcuCacheAdapter
  - CacheAdapterInterface
  - DoctrineCacheAdapter
  - NullCacheAdapter
  - PhpRedisCacheAdapter

  Use an appropiate PSR-6 or PRS-16 cache adapter as a replacement. The SDK uses the [cache\apcu-adapter](https://packagist.org/packages/cache/apcu-adapter) as default or if available the [cache\filesystem-adapter](https://packagist.org/packages/cache/filesystem-adapter)
* Deprecations have been removed
  - FileRequest
     - use FileUploadRequest
  - CustomerChangeNameAction
    - use CustomerSetFirstNameAction, CustomerSetLastNameAction, CustomerSetMiddleNameAction or CustomerSetTitleAction
  - ProductSetSkuNotStageableAction
    - use ProductSetSkuAction
* Context doesn't extend Pimple\Container anymore
* Pimple has been removed as a dependency

### DEPRECATION NOTE

The class ```Commercetools\Commons\Helper\PriceFinder``` has been deprecated. Please use the
[price selection](http://docs.commercetools.com/http-api-projects-products.html#price-selection) functionality of Composable Commerce. E.g. ```ProductProjectionSearchRequest::of()->currency('EUR')->country('DE')```


<a name="2.0.0-RC1"></a>
# [2.0.0-RC1](https://github.com/commercetools/commercetools-php-sdk/compare/v1.7.0...v2.0.0-RC1) (2017-03-13)


### Bug Fixes

* **AssetDraft:** correct type for custom field object ([abc0afd](https://github.com/commercetools/commercetools-php-sdk/commit/abc0afd))
* **Customer:** fix create email token request with TTL ([8367ef6](https://github.com/commercetools/commercetools-php-sdk/commit/8367ef6))

### Code Refactoring

* **OAuth:** change access scope of getCacheAdapter method ([c6b27ec](https://github.com/commercetools/commercetools-php-sdk/commit/c6b27ec))
* **ProductSearch:** disable markMatchingVariants by default ([41711a8](https://github.com/commercetools/commercetools-php-sdk/commit/41711a8))

### Features

* **Cache:** support PSR-16 cache implementations ([c3ceac7](https://github.com/commercetools/commercetools-php-sdk/commit/c3ceac7)), closes [#297](https://github.com/commercetools/commercetools-php-sdk/issues/297)


### BREAKING CHANGES

* AssetDraft: AssetDraft requires CustomFieldObjectDraft instead of CustomFieldObject

  Before:

  ```
  $assetDraft = AssetDraft::of()->setCustom(CustomFieldObject::of());
  ```

  After:

  ```
  $assetDraft = AssetDraft::of()->setCustom(CustomFieldObjectDraft::of());
  ```
* OAuth: Manager::getCacheAdapter() method scope has been changed from public to protected
* ProductSearch: markMatchingVariants has been disabled by default

  For performance reasons the markMatchingVariants flag has been disabled by default. In order to use markMatchingVariants feature please enable it explicit.

  Before:
  ```
  $request = ProductProjectionSearchRequest::of();
  ```

  After:
  ```
  $request = ProductProjectionSearchRequest::of()->markMatchingVariants(true);
  ```

* PHP minimum version is now 5.6
* Token caching is now using [PSR-6](https://packagist.org/providers/psr/cache-implementation) or [PSR-16](https://packagist.org/providers/psr/simple-cache-implementation) cache adapters only.
  Removed classes:
  - AbstractCacheAdapter
  - ApcCacheAdapter
  - ApcuCacheAdapter
  - CacheAdapterInterface
  - DoctrineCacheAdapter
  - NullCacheAdapter
  - PhpRedisCacheAdapter

  Use an appropiate PSR-6 or PRS-16 cache adapter as a replacement. The SDK uses the [cache\apcu-adapter](https://packagist.org/packages/cache/apcu-adapter) as default or if available the [cache\filesystem-adapter](https://packagist.org/packages/cache/filesystem-adapter)
* Deprecations have been removed
  - FileRequest
    - use FileUploadRequest
  - CustomerChangeNameAction
    - use CustomerSetFirstNameAction, CustomerSetLastNameAction, CustomerSetMiddleNameAction or CustomerSetTitleAction
  - ProductSetSkuNotStageableAction
    - use ProductSetSkuAction
* Context doesn't extend Pimple\Container anymore
* Pimple has been removed as a dependency


<a name="1.7.0"></a>
# [1.7.0](https://github.com/commercetools/commercetools-php-sdk/compare/v1.6.1...v1.7.0) (2017-03-02)


### Bug Fixes

* **CustomerDraft:** correct type mapping for customer draft dateOfBirth ([1233835](https://github.com/commercetools/commercetools-php-sdk/commit/1233835))
* **State:** add roles to state draft model ([33bb512](https://github.com/commercetools/commercetools-php-sdk/commit/33bb512))

### Features

* **Cart:** support automatic deletion of old carts ([47c89b3](https://github.com/commercetools/commercetools-php-sdk/commit/47c89b3)), closes [#294](https://github.com/commercetools/commercetools-php-sdk/issues/294)
* **Cart:** support tax rounding mode ([1c22189](https://github.com/commercetools/commercetools-php-sdk/commit/1c22189)), closes [#290](https://github.com/commercetools/commercetools-php-sdk/issues/290)
* **Category:** add assets to categories ([5a7716d](https://github.com/commercetools/commercetools-php-sdk/commit/5a7716d)), closes [#285](https://github.com/commercetools/commercetools-php-sdk/issues/285)
* **OAuth:** Client scope can be left empty ([7f1ddec](https://github.com/commercetools/commercetools-php-sdk/commit/7f1ddec)), closes [#291](https://github.com/commercetools/commercetools-php-sdk/issues/291)
* **ShoppingList:** support shopping list ([d8fdf4d](https://github.com/commercetools/commercetools-php-sdk/commit/d8fdf4d)), closes [#287](https://github.com/commercetools/commercetools-php-sdk/issues/287)



<a name="1.6.1"></a>
## [1.6.1](https://github.com/commercetools/commercetools-php-sdk/compare/v1.6.0...v1.6.1) (2017-02-14)


### Bug Fixes

* **Product:** correct type of sku in product variant ([526c4c3](https://github.com/commercetools/commercetools-php-sdk/commit/526c4c3)), closes [#292](https://github.com/commercetools/commercetools-php-sdk/issues/292)



<a name="1.6.0"></a>
# [1.6.0](https://github.com/commercetools/commercetools-php-sdk/compare/v1.5.1...v1.6.0) (2017-01-09)


### Bug Fixes

* **Cart:** rewind line items in helper method ([cbd2426](https://github.com/commercetools/commercetools-php-sdk/commit/cbd2426)), closes [#281](https://github.com/commercetools/commercetools-php-sdk/issues/281)
* **Client:** typo in call to getOauthManager ([e9cc4a7](https://github.com/commercetools/commercetools-php-sdk/commit/e9cc4a7)), closes [#277](https://github.com/commercetools/commercetools-php-sdk/issues/277)

### Features

* **Cart:** add product type reference to line item ([e795540](https://github.com/commercetools/commercetools-php-sdk/commit/e795540)), closes [#280](https://github.com/commercetools/commercetools-php-sdk/issues/280)
* **Channel:** add geo location information to channels ([b4d6024](https://github.com/commercetools/commercetools-php-sdk/commit/b4d6024)), closes [#272](https://github.com/commercetools/commercetools-php-sdk/issues/272)
* **Channel:** add setGeolocation update action ([db4b46e](https://github.com/commercetools/commercetools-php-sdk/commit/db4b46e))
* **Customer:** add shipping and billing address ids ([6e48320](https://github.com/commercetools/commercetools-php-sdk/commit/6e48320)), closes [#278](https://github.com/commercetools/commercetools-php-sdk/issues/278)
* **GraphQL:** support GraphQL variables ([61eca3e](https://github.com/commercetools/commercetools-php-sdk/commit/61eca3e)), closes [#271](https://github.com/commercetools/commercetools-php-sdk/issues/271)
* **ProductSearch:** add productCount to FacetResult ([8e0c946](https://github.com/commercetools/commercetools-php-sdk/commit/8e0c946)), closes [#279](https://github.com/commercetools/commercetools-php-sdk/issues/279)
* **Subscriptions:** Support AwsSNS for subscriptions ([f4e2c0e](https://github.com/commercetools/commercetools-php-sdk/commit/f4e2c0e)), closes [#282](https://github.com/commercetools/commercetools-php-sdk/issues/282)



<a name="1.5.1"></a>
## [1.5.1](https://github.com/commercetools/commercetools-php-sdk/compare/v1.5.0...v1.5.1) (2016-11-21)


### Bug Fixes

* **Subscription:** fix typo in subscription delivery model ([5e1761b](https://github.com/commercetools/commercetools-php-sdk/commit/5e1761b))



<a name="1.5.0"></a>
# [1.5.0](https://github.com/commercetools/commercetools-php-sdk/compare/v1.3.1...v1.5.0) (2016-11-17)


### Bug Fixes

* **Example:** fix typo in autoloader ([a686dc4](https://github.com/commercetools/commercetools-php-sdk/commit/a686dc4))
* **HttpClient:** fix invalid http client access ([8c0577a](https://github.com/commercetools/commercetools-php-sdk/commit/8c0577a)), closes [#264](https://github.com/commercetools/commercetools-php-sdk/issues/264)
* **Product:** remove uuid query in ProductProjectionBySlugGetRequest ([583f656](https://github.com/commercetools/commercetools-php-sdk/commit/583f656)), closes [#251](https://github.com/commercetools/commercetools-php-sdk/issues/251)
* **Search:** fix fuzzy level parameter usage ([42a93a7](https://github.com/commercetools/commercetools-php-sdk/commit/42a93a7))
* **ShippingMethod:** fix response object class of shipping method request by cart or location ([76b18bc](https://github.com/commercetools/commercetools-php-sdk/commit/76b18bc))
* **StateRenderer:** fix for no transition available ([2d1c557](https://github.com/commercetools/commercetools-php-sdk/commit/2d1c557))

### Features

* **Cart:** support change of custom line item quantity and price ([63d78e5](https://github.com/commercetools/commercetools-php-sdk/commit/63d78e5)), closes [#256](https://github.com/commercetools/commercetools-php-sdk/issues/256)
* **Cart:** support external line item total price ([417e78c](https://github.com/commercetools/commercetools-php-sdk/commit/417e78c)), closes [#247](https://github.com/commercetools/commercetools-php-sdk/issues/247)
* **Common:** add externalId to address object ([76dc332](https://github.com/commercetools/commercetools-php-sdk/commit/76dc332))
* **CustomObject:** add constructor using custom object draft ([7482d1b](https://github.com/commercetools/commercetools-php-sdk/commit/7482d1b)), closes [#258](https://github.com/commercetools/commercetools-php-sdk/issues/258)
* **CustomObject:** add reference model for custom objects ([566cf22](https://github.com/commercetools/commercetools-php-sdk/commit/566cf22)), closes [#248](https://github.com/commercetools/commercetools-php-sdk/issues/248)
* **Filter:** add method to create a subtree filter with an array of IDs ([ac487a3](https://github.com/commercetools/commercetools-php-sdk/commit/ac487a3)), closes [#257](https://github.com/commercetools/commercetools-php-sdk/issues/257)
* **Inventory:** add inventory deleted message ([699a8c7](https://github.com/commercetools/commercetools-php-sdk/commit/699a8c7)), closes [#245](https://github.com/commercetools/commercetools-php-sdk/issues/245)
* **Inventory:** support customizable inventory entries ([31f16db](https://github.com/commercetools/commercetools-php-sdk/commit/31f16db)), closes [#246](https://github.com/commercetools/commercetools-php-sdk/issues/246)
* **Logger:** add correlation id to log as context object ([512536b](https://github.com/commercetools/commercetools-php-sdk/commit/512536b))
* **Product:** query product by slug with single language ([88cd9e2](https://github.com/commercetools/commercetools-php-sdk/commit/88cd9e2)), closes [#250](https://github.com/commercetools/commercetools-php-sdk/issues/250)
* **Product:** set discounted price for product variant ([bdfd8c7](https://github.com/commercetools/commercetools-php-sdk/commit/bdfd8c7)), closes [#267](https://github.com/commercetools/commercetools-php-sdk/issues/267)
* **Product:** support key for product and product variant ([39f356a](https://github.com/commercetools/commercetools-php-sdk/commit/39f356a)), closes [#259](https://github.com/commercetools/commercetools-php-sdk/issues/259)
* **ProductType:** add change label actions for enum values ([d812fec](https://github.com/commercetools/commercetools-php-sdk/commit/d812fec))
* **Reference:** resolve correct reference model by typeId ([8f76ec4](https://github.com/commercetools/commercetools-php-sdk/commit/8f76ec4))
* **Request:** add generic PSR-7-Request ([5b374eb](https://github.com/commercetools/commercetools-php-sdk/commit/5b374eb))
* **Search:** add markMatchingVariants flag to search ([f4ac2c8](https://github.com/commercetools/commercetools-php-sdk/commit/f4ac2c8)), closes [#270](https://github.com/commercetools/commercetools-php-sdk/issues/270)
* **Subscriptions:** add subscription requests and models ([b184870](https://github.com/commercetools/commercetools-php-sdk/commit/b184870))
* **Subscription:** add delivery objects ([8fae7f8](https://github.com/commercetools/commercetools-php-sdk/commit/8fae7f8))
* **Subscription:** add subscription update actions ([1d3de36](https://github.com/commercetools/commercetools-php-sdk/commit/1d3de36))



<a name="1.4.0"></a>
# [1.4.0](https://github.com/commercetools/commercetools-php-sdk/compare/v1.3.1...v1.4.0) (2016-10-05)

### Features

* **Cart:** support change of custom line item quantity and price ([63d78e5](https://github.com/commercetools/commercetools-php-sdk/commit/63d78e5)), closes [#256](https://github.com/commercetools/commercetools-php-sdk/issues/256)
* **Cart:** support external line item total price ([417e78c](https://github.com/commercetools/commercetools-php-sdk/commit/417e78c)), closes [#247](https://github.com/commercetools/commercetools-php-sdk/issues/247)
* **CustomObject:** add constructor using custom object draft ([7482d1b](https://github.com/commercetools/commercetools-php-sdk/commit/7482d1b)), closes [#258](https://github.com/commercetools/commercetools-php-sdk/issues/258)
* **CustomObject:** add reference model for custom objects ([566cf22](https://github.com/commercetools/commercetools-php-sdk/commit/566cf22)), closes [#248](https://github.com/commercetools/commercetools-php-sdk/issues/248)
* **Filter:** add method to create a subtree filter with an array of IDs ([ac487a3](https://github.com/commercetools/commercetools-php-sdk/commit/ac487a3)), closes [#257](https://github.com/commercetools/commercetools-php-sdk/issues/257)
* **Inventory:** add inventory deleted message ([699a8c7](https://github.com/commercetools/commercetools-php-sdk/commit/699a8c7)), closes [#245](https://github.com/commercetools/commercetools-php-sdk/issues/245)
* **Inventory:** support customizable inventory entries ([31f16db](https://github.com/commercetools/commercetools-php-sdk/commit/31f16db)), closes [#246](https://github.com/commercetools/commercetools-php-sdk/issues/246)
* **Logger:** add correlation id to logger as context object ([512536b](https://github.com/commercetools/commercetools-php-sdk/commit/512536b))
* **Product:** query product by slug with single language ([88cd9e2](https://github.com/commercetools/commercetools-php-sdk/commit/88cd9e2)), closes [#250](https://github.com/commercetools/commercetools-php-sdk/issues/250)
* **Product:** support key for product and product variant ([39f356a](https://github.com/commercetools/commercetools-php-sdk/commit/39f356a)), closes [#259](https://github.com/commercetools/commercetools-php-sdk/issues/259)
* **Reference:** resolve correct reference model by typeId ([8f76ec4](https://github.com/commercetools/commercetools-php-sdk/commit/8f76ec4))



<a name="1.3.1"></a>
## [1.3.1](https://github.com/commercetools/commercetools-php-sdk/compare/v1.3.0...v1.3.1) (2016-08-30)


### Bug Fixes

* **CustomObject:** add version to custom object draft ([4963073](https://github.com/commercetools/commercetools-php-sdk/commit/4963073)), closes [#249](https://github.com/commercetools/commercetools-php-sdk/issues/249)



<a name="1.3.0"></a>
# [1.3.0](https://github.com/commercetools/commercetools-php-sdk/compare/v1.2.3...v1.3.0) (2016-08-10)

### Features

* **Address:** add fax field to address ([cb1dda2](https://github.com/commercetools/commercetools-php-sdk/commit/cb1dda2)), closes [#236](https://github.com/commercetools/commercetools-php-sdk/issues/236)
* **Channel:** add Address field to Channel ([66a40a9](https://github.com/commercetools/commercetools-php-sdk/commit/66a40a9)), closes [#237](https://github.com/commercetools/commercetools-php-sdk/issues/237)
* **Localization:** add setLocale action to cart, order and customer ([17c5672](https://github.com/commercetools/commercetools-php-sdk/commit/17c5672)), closes [#235](https://github.com/commercetools/commercetools-php-sdk/issues/235)
* **Order:** add actions to update customer email, shipping and billing address for orders ([23e0193](https://github.com/commercetools/commercetools-php-sdk/commit/23e0193)), closes [#238](https://github.com/commercetools/commercetools-php-sdk/issues/238)
* **Order:** import order with stock update ([a824dae](https://github.com/commercetools/commercetools-php-sdk/commit/a824dae)), closes [#234](https://github.com/commercetools/commercetools-php-sdk/issues/234)
* **Product:** support assets ([43f8dd6](https://github.com/commercetools/commercetools-php-sdk/commit/43f8dd6)), closes [#241](https://github.com/commercetools/commercetools-php-sdk/issues/241)
* **Project:** add messages field to project ([4deb11f](https://github.com/commercetools/commercetools-php-sdk/commit/4deb11f)), closes [#239](https://github.com/commercetools/commercetools-php-sdk/issues/239)
* **Search:** add subtree filter model ([9fa6527](https://github.com/commercetools/commercetools-php-sdk/commit/9fa6527)), closes [#244](https://github.com/commercetools/commercetools-php-sdk/issues/244)



<a name="1.2.3"></a>
## [1.2.3](https://github.com/commercetools/commercetools-php-sdk/compare/v1.2.2...v1.2.3) (2016-07-14)


### Bug Fixes

* **ProductType:** fix NestedType field definitions ([982d51d](https://github.com/commercetools/commercetools-php-sdk/commit/982d51d)), closes [#231](https://github.com/commercetools/commercetools-php-sdk/issues/231)



<a name="1.2.2"></a>
## [1.2.2](https://github.com/commercetools/commercetools-php-sdk/compare/v1.2.1...v1.2.2) (2016-07-07)


### Bug Fixes

* **Suggestion:** correct type mapping for suggestion result ([d46008c](https://github.com/commercetools/commercetools-php-sdk/commit/d46008c)), closes [#228](https://github.com/commercetools/commercetools-php-sdk/issues/228)



<a name="1.2.1"></a>
## [1.2.1](https://github.com/commercetools/commercetools-php-sdk/compare/v1.2.0...v1.2.1) (2016-07-05)

* **OAuth:** remove dependency for CacheItem implementation ([59265b3](https://github.com/commercetools/commercetools-php-sdk/commit/59265b3))



<a name="1.2.0"></a>
# [1.2.0](https://github.com/commercetools/commercetools-php-sdk/compare/v1.1.1...v1.2.0) (2016-06-30)


### Bug Fixes

* **Client:** fix format of UserAgent header ([bc37b2f](https://github.com/commercetools/commercetools-php-sdk/commit/bc37b2f))


### Features

* **Cart:** add updateProductData flag to cart recalculate action ([827a392](https://github.com/commercetools/commercetools-php-sdk/commit/827a392)), closes [#220](https://github.com/commercetools/commercetools-php-sdk/issues/220)
* **Cart:** support anonymous checkout for me endpoint ([a89f38c](https://github.com/commercetools/commercetools-php-sdk/commit/a89f38c)), closes [#221](https://github.com/commercetools/commercetools-php-sdk/issues/221)
* **MeEndpoint:** add get active cart request ([e61d29d](https://github.com/commercetools/commercetools-php-sdk/commit/e61d29d)), closes [#224](https://github.com/commercetools/commercetools-php-sdk/issues/224)
* **MyProfile:** support customer profile on me endpoint ([3cc0f73](https://github.com/commercetools/commercetools-php-sdk/commit/3cc0f73)), closes [#223](https://github.com/commercetools/commercetools-php-sdk/issues/223)
* **Orders:** add support for orders at me endpoint ([e776230](https://github.com/commercetools/commercetools-php-sdk/commit/e776230)), closes [#222](https://github.com/commercetools/commercetools-php-sdk/issues/222)
* **Product:** add image upload request ([e8985bd](https://github.com/commercetools/commercetools-php-sdk/commit/e8985bd)), closes [#146](https://github.com/commercetools/commercetools-php-sdk/issues/146)
* **Product:** support product price selection ([02026a7](https://github.com/commercetools/commercetools-php-sdk/commit/02026a7)),([ebac224](https://github.com/commercetools/commercetools-php-sdk/commit/ebac224)), closes [#225](https://github.com/commercetools/commercetools-php-sdk/issues/225)
* **ProductSearch:** add fuzzy level support ([617a4ea](https://github.com/commercetools/commercetools-php-sdk/commit/617a4ea)), closes [#217](https://github.com/commercetools/commercetools-php-sdk/issues/217)



<a name="1.1.1"></a>
## [1.1.1](https://github.com/commercetools/commercetools-php-sdk/compare/v1.1.0...v1.1.1) (2016-06-07)


### Bug Fixes

* **LocalizedEnumCollection:** use correct type for LocalizedEnumCollection elements ([9492a8c](https://github.com/commercetools/commercetools-php-sdk/commit/9492a8c)), closes [#218](https://github.com/commercetools/commercetools-php-sdk/issues/218)



<a name="1.1.0"></a>
# [1.1.0](https://github.com/commercetools/commercetools-php-sdk/compare/v1.0.1...v1.1.0) (2016-05-27)


### Bug Fixes

* **JsonObject:** fix JsonObject::hasField method to return if the field has a value set ([c2eaed5](https://github.com/commercetools/commercetools-php-sdk/commit/c2eaed5)), closes [#173](https://github.com/commercetools/commercetools-php-sdk/issues/173)

### Features

* **Cache:** add support for PSR-6 cache adapter ([e6cbd27](https://github.com/commercetools/commercetools-php-sdk/commit/e6cbd27)), closes [#194](https://github.com/commercetools/commercetools-php-sdk/issues/194)
* **Cart:** support new cart tax modes ([f6bfeeb](https://github.com/commercetools/commercetools-php-sdk/commit/f6bfeeb)), closes [#207](https://github.com/commercetools/commercetools-php-sdk/issues/207)
* **Customer:** support anonymous cart sign in mode for customer login ([e94ac48](https://github.com/commercetools/commercetools-php-sdk/commit/e94ac48)), closes [#212](https://github.com/commercetools/commercetools-php-sdk/issues/212)
* **Error:** add DiscountCodeNonApplicable error ([a42e90d](https://github.com/commercetools/commercetools-php-sdk/commit/a42e90d)), closes [#198](https://github.com/commercetools/commercetools-php-sdk/issues/198)
* **Product:** add changeMasterVariant update action ([48d1a42](https://github.com/commercetools/commercetools-php-sdk/commit/48d1a42)), closes [#204](https://github.com/commercetools/commercetools-php-sdk/issues/204)
* **Product:** add getAllVariants helper method to product data ([006e984](https://github.com/commercetools/commercetools-php-sdk/commit/006e984)), closes [#213](https://github.com/commercetools/commercetools-php-sdk/issues/213)
* **Product:** add image move to position update action ([c24839b](https://github.com/commercetools/commercetools-php-sdk/commit/c24839b)), closes [#206](https://github.com/commercetools/commercetools-php-sdk/issues/206)
* **Product:** add scopedPrice and scopePriceDiscounted to ProductVariant model ([f7d25d8](https://github.com/commercetools/commercetools-php-sdk/commit/f7d25d8)), closes [#201](https://github.com/commercetools/commercetools-php-sdk/issues/201)
* **Product:** add support to publish product on creation ([ee71818](https://github.com/commercetools/commercetools-php-sdk/commit/ee71818)), closes [#203](https://github.com/commercetools/commercetools-php-sdk/issues/203)
* **Product:** support availableQuantity for product variant availability ([dbc4c48](https://github.com/commercetools/commercetools-php-sdk/commit/dbc4c48)), closes [#202](https://github.com/commercetools/commercetools-php-sdk/issues/202)
* **Product:** support fuzzy query for product suggest ([1d59870](https://github.com/commercetools/commercetools-php-sdk/commit/1d59870)), closes [#205](https://github.com/commercetools/commercetools-php-sdk/issues/205)
* **Query:** add support for multiple where query parameters ([591c926](https://github.com/commercetools/commercetools-php-sdk/commit/591c926)), closes [#196](https://github.com/commercetools/commercetools-php-sdk/issues/196)
* **Request:** support reference expansion for CRUD requests ([0f29ea7](https://github.com/commercetools/commercetools-php-sdk/commit/0f29ea7)), closes [#199](https://github.com/commercetools/commercetools-php-sdk/issues/199)
* **Review:** add review messages ([f20c858](https://github.com/commercetools/commercetools-php-sdk/commit/f20c858))
* **UpdateRequest:** add hasActions method to update requests ([cb98ffd](https://github.com/commercetools/commercetools-php-sdk/commit/cb98ffd))



<a name="1.0.1"></a>
## [1.0.1](https://github.com/commercetools/commercetools-php-sdk/compare/v1.0.0...v1.0.1) (2016-05-17)


### Bug Fixes

* **Product:** fix mapping for product variant availability ([c0c461f](https://github.com/commercetools/commercetools-php-sdk/commit/c0c461f))



<a name="1.0.0"></a>
# [1.0.0](https://github.com/commercetools/commercetools-php-sdk/compare/v1.0.0-RC12...v1.0.0) (2016-05-02)

There had been no changes


<a name="1.0.0-RC12"></a>
# [1.0.0-RC12](https://github.com/commercetools/commercetools-php-sdk/compare/v1.0.0-RC11...v1.0.0-RC12) (2016-05-02)


### Bug Fixes

* **Cart:** fix type of custom line-item slug ([34367d5](https://github.com/commercetools/commercetools-php-sdk/commit/34367d5))
* **CustomLineItem:** fix type of slug in custom line-item ([d8d7d2a](https://github.com/commercetools/commercetools-php-sdk/commit/d8d7d2a))

### Features

* **Cart:** add helper to calculate line item count ([291bd05](https://github.com/commercetools/commercetools-php-sdk/commit/291bd05))
* **Client:** add support for oauth password and refresh token flow ([fe23c8b](https://github.com/commercetools/commercetools-php-sdk/commit/fe23c8b)), closes [#191](https://github.com/commercetools/commercetools-php-sdk/issues/191)
* **Error:** add oauth error classes ([92eec57](https://github.com/commercetools/commercetools-php-sdk/commit/92eec57))
* **Product:** add support to use sku to identify a product variant in update action ([7f1979b](https://github.com/commercetools/commercetools-php-sdk/commit/7f1979b)), closes [#192](https://github.com/commercetools/commercetools-php-sdk/issues/192)
* **Reference:** add constructor ofKey constructor to references ([e6fafc3](https://github.com/commercetools/commercetools-php-sdk/commit/e6fafc3))

### BREAKING CHANGES

* removed Facet, Filter, FilterRange and FilterRangeCollection in namespace Commercetools\Core\Model\Product.  Please use the classes found in namespace Commercetools\Core\Model\Product\Search instead.


<a name="1.0.0-RC11"></a>
# [1.0.0-RC11](https://github.com/commercetools/commercetools-php-sdk/compare/v1.0.0-RC10...v1.0.0-RC11) (2016-04-06)


### Bug Fixes

* **Product:** change type of price collection ([8cc1262](https://github.com/commercetools/commercetools-php-sdk/commit/8cc1262))

### Code Refactoring

* **Customer:** adjust customer email verification request to API changes ([2e3dd32](https://github.com/commercetools/commercetools-php-sdk/commit/2e3dd32))
* **Customer:** adjust customer password change request to API changes ([318e93f](https://github.com/commercetools/commercetools-php-sdk/commit/318e93f))

### Features

* **Client:** add support for oauth scopes ([5545dfd](https://github.com/commercetools/commercetools-php-sdk/commit/5545dfd))
* **Client:** log response body and headers of api exceptions ([f371979](https://github.com/commercetools/commercetools-php-sdk/commit/f371979)), closes [#186](https://github.com/commercetools/commercetools-php-sdk/issues/186)
* **Product:** add update action for stageable SKU ([870a1f8](https://github.com/commercetools/commercetools-php-sdk/commit/870a1f8))
* **Response:** add getter for correlation id ([6029a02](https://github.com/commercetools/commercetools-php-sdk/commit/6029a02)), closes [#69](https://github.com/commercetools/commercetools-php-sdk/issues/69)


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
# [1.0.0-RC10](https://github.com/commercetools/commercetools-php-sdk/compare/v1.0.0-RC9...v1.0.0-RC10) (2016-03-22)


### Bug Fixes

* **CartDiscount:** fix cart discount target with correct type ([220c1da](https://github.com/commercetools/commercetools-php-sdk/commit/220c1da))
* **Client:** fix guzzle5 adapter to send user agent ([3ae8748](https://github.com/commercetools/commercetools-php-sdk/commit/3ae8748))
* **Collection:** fix add function for collection ([993cddd](https://github.com/commercetools/commercetools-php-sdk/commit/993cddd))
* **Collection:** fix collection iterator for associative collections ([2442677](https://github.com/commercetools/commercetools-php-sdk/commit/2442677))
* **Customer:** fix exception on getDefaultAddresses for empty customer address ([7bd63a4](https://github.com/commercetools/commercetools-php-sdk/commit/7bd63a4))
* **DateDecorator:** fix date overflow for date decorator on serialization ([9009b8f](https://github.com/commercetools/commercetools-php-sdk/commit/9009b8f))
* **Inventory:** fix setSupplyChannel action for inventory update ([f356179](https://github.com/commercetools/commercetools-php-sdk/commit/f356179))
* **LocalizedString:** use graceful flag for language property getter ([621195d](https://github.com/commercetools/commercetools-php-sdk/commit/621195d))
* **Payment:** correct type mapping for transaction state ([0c6f36d](https://github.com/commercetools/commercetools-php-sdk/commit/0c6f36d))
* **Reference:** remove obj from serialized result if resource is embedded ([79f8cba](https://github.com/commercetools/commercetools-php-sdk/commit/79f8cba))
* **Review:** fix locale serialization for review models ([973129d](https://github.com/commercetools/commercetools-php-sdk/commit/973129d))

### Features

* **Category:** add metaDescription, metaKeywords, metaTitle to Category and CategoryDraft model ([5468676](https://github.com/commercetools/commercetools-php-sdk/commit/5468676))
* **Customer:** add update actions to set customer's firstName, middleName, lastName and title ([b122225](https://github.com/commercetools/commercetools-php-sdk/commit/b122225))
* **GraphQL:** add request to query GraphQL endpoint ([182641a](https://github.com/commercetools/commercetools-php-sdk/commit/182641a))
* **LineItem:** add helper function to calculate discounted price ([961a493](https://github.com/commercetools/commercetools-php-sdk/commit/961a493))
* **Payment:** add change amount planned update action ([2815f98](https://github.com/commercetools/commercetools-php-sdk/commit/2815f98))
* **Product:** add product setCategoryOrderHint action ([9f8de04](https://github.com/commercetools/commercetools-php-sdk/commit/9f8de04))
* **Product:** add set prices update action ([a8c4206](https://github.com/commercetools/commercetools-php-sdk/commit/a8c4206))
* **ProductSearch:** support POST for filters and facets ([caeb0a5](https://github.com/commercetools/commercetools-php-sdk/commit/caeb0a5))
* **ProductType:** add change isSearchable update action ([95395f9](https://github.com/commercetools/commercetools-php-sdk/commit/95395f9))
* **ProductType:** add inputTip to attribute definition ([09288a4](https://github.com/commercetools/commercetools-php-sdk/commit/09288a4))
* **ProductType:** add key to product type ([4e1d393](https://github.com/commercetools/commercetools-php-sdk/commit/4e1d393))
* **Review:** add by key requests ([ebc4ece](https://github.com/commercetools/commercetools-php-sdk/commit/ebc4ece))
* **Review:** add update by key request ([710c89e](https://github.com/commercetools/commercetools-php-sdk/commit/710c89e))
* **Review:** update Review requests and models to API changes ([6634658](https://github.com/commercetools/commercetools-php-sdk/commit/6634658))
* **ShippingMethod:** add delete request for shipping methods ([e5510f6](https://github.com/commercetools/commercetools-php-sdk/commit/e5510f6))
* **State:** add set, add and remove roles update action ([7c9a28d](https://github.com/commercetools/commercetools-php-sdk/commit/7c9a28d))
* **Type:** add by key delete requests ([509616f](https://github.com/commercetools/commercetools-php-sdk/commit/509616f))
* **Type:** add type change key action ([1c2ebf4](https://github.com/commercetools/commercetools-php-sdk/commit/1c2ebf4))
* **Type:** add type update by key request ([72e4bd2](https://github.com/commercetools/commercetools-php-sdk/commit/72e4bd2))
* **Types:** add delete type by key request ([2450b7a](https://github.com/commercetools/commercetools-php-sdk/commit/2450b7a))
* **Types:** add request to get type by key ([2b34ae9](https://github.com/commercetools/commercetools-php-sdk/commit/2b34ae9)), closes [#169](https://github.com/commercetools/commercetools-php-sdk/issues/169)

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
# [1.0.0-RC9](https://github.com/commercetools/commercetools-php-sdk/compare/v1.0.0-RC8...v1.0.0-RC9) (2016-01-11)


### Bug Fixes

* **Collection:** fix serialization of collection with primitive types ([0e1251f](https://github.com/commercetools/commercetools-php-sdk/commit/0e1251f))
* **CustomField:** fix custom field object draft to reflect API changes ([90156aa](https://github.com/commercetools/commercetools-php-sdk/commit/90156aa))
* **CustomFields:** fix custom type update actions to match changed API ([26efdcf](https://github.com/commercetools/commercetools-php-sdk/commit/26efdcf))
* **CustomObject:** remove type for custom object value ([b37c604](https://github.com/commercetools/commercetools-php-sdk/commit/b37c604)), closes [#163](https://github.com/commercetools/commercetools-php-sdk/issues/163)
* **Product:** fix type of priceId ([23c2de5](https://github.com/commercetools/commercetools-php-sdk/commit/23c2de5))
* **ProductProjection:** fix context of getAllVariants helper method ([28526db](https://github.com/commercetools/commercetools-php-sdk/commit/28526db))

### Features

* **Cart:** add fields to cart draft ([8b2ab3b](https://github.com/commercetools/commercetools-php-sdk/commit/8b2ab3b))
* **Category:** add CategoryCreated and CategorySlugChanged messages ([014dde2](https://github.com/commercetools/commercetools-php-sdk/commit/014dde2))
* **CategoryCollection:** add getById to CategoryCollection ([1a79cbc](https://github.com/commercetools/commercetools-php-sdk/commit/1a79cbc))
* **Channel:** add custom field to channel ([5e9601d](https://github.com/commercetools/commercetools-php-sdk/commit/5e9601d))
* **Client:** add config option for accept encoding (e.g. enabling gzip compression) ([c57f2ee](https://github.com/commercetools/commercetools-php-sdk/commit/c57f2ee))
* **Client:** add gzip as default acceptEncoding ([2ddd99d](https://github.com/commercetools/commercetools-php-sdk/commit/2ddd99d))
* **CurrencyFormatter:** change currencyFormatter to use fraction digits from intl extension ([e8d058b](https://github.com/commercetools/commercetools-php-sdk/commit/e8d058b))
* **Customer:** add CustomerCreated message ([12c9bff](https://github.com/commercetools/commercetools-php-sdk/commit/12c9bff))
* **Customer:** add getter for default shipping and billing address ([7b776f9](https://github.com/commercetools/commercetools-php-sdk/commit/7b776f9)), closes [#162](https://github.com/commercetools/commercetools-php-sdk/issues/162)
* **CustomFields:** update custom field draft to API changes ([dfae984](https://github.com/commercetools/commercetools-php-sdk/commit/dfae984))
* **CustomObject:** add delete by id request ([9eb8ba7](https://github.com/commercetools/commercetools-php-sdk/commit/9eb8ba7))
* **Inventory:** add SetSupplyChannel action ([d453e5e](https://github.com/commercetools/commercetools-php-sdk/commit/d453e5e))
* **Payment:** add change transaction state, timestamp and interactionId actions ([3eee823](https://github.com/commercetools/commercetools-php-sdk/commit/3eee823))
* **Payment:** add PaymentTransactionChanged message ([7c3e6d8](https://github.com/commercetools/commercetools-php-sdk/commit/7c3e6d8))
* **Payment:** add state and id to payment transaction ([b7ee577](https://github.com/commercetools/commercetools-php-sdk/commit/b7ee577))
* **Product:** add price field to variant for price selection ([ea8169e](https://github.com/commercetools/commercetools-php-sdk/commit/ea8169e))
* **Product:** add ProductCreated and ProductSlugChanged messages ([dbb8a28](https://github.com/commercetools/commercetools-php-sdk/commit/dbb8a28))
* **Product:** support resource identifier for product type at product creation ([d7e1980](https://github.com/commercetools/commercetools-php-sdk/commit/d7e1980))
* **ProductSearch:** add matching variant to ProductVariant object ([2e336df](https://github.com/commercetools/commercetools-php-sdk/commit/2e336df))
* **ProductSearch:** add price select methods for search ([ad8b4cd](https://github.com/commercetools/commercetools-php-sdk/commit/ad8b4cd))
* **ProductSearch:** add price select methods to ProductProjectionSearchRequest ([51f889d](https://github.com/commercetools/commercetools-php-sdk/commit/51f889d))
* **ProductSearch:** add price select parameters ([f1717b8](https://github.com/commercetools/commercetools-php-sdk/commit/f1717b8))
* **ProductType:** add get, update and delete by key requests ([0ad3973](https://github.com/commercetools/commercetools-php-sdk/commit/0ad3973))
* **ProductType:** add getByName and getById to ProductTypeCollection ([2b2e005](https://github.com/commercetools/commercetools-php-sdk/commit/2b2e005))
* **Request:** add min and max for query limit ([66947e6](https://github.com/commercetools/commercetools-php-sdk/commit/66947e6))


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
# [1.0.0-RC8](https://github.com/commercetools/commercetools-php-sdk/compare/v1.0.0-RC7...v1.0.0-RC8) (2015-10-30)


### Bug Fixes

* **Cart:** typo in custom line item model ([c583fb9](https://github.com/commercetools/commercetools-php-sdk/commit/c583fb9))
* **JsonObject:** add missing static keyword to named constructors ([f83e4c6](https://github.com/commercetools/commercetools-php-sdk/commit/f83e4c6))
* **JsonObject:** fix error message for unknown method ([22431f8](https://github.com/commercetools/commercetools-php-sdk/commit/22431f8))
* **Payment:** add missing type for payment transactions ([c6d3765](https://github.com/commercetools/commercetools-php-sdk/commit/c6d3765))
* **Payment:** correct type for PaymentInfo model ([b942a06](https://github.com/commercetools/commercetools-php-sdk/commit/b942a06))

### Features

* **CustomFields:** add customs fields and types for prices ([cfbc0bb](https://github.com/commercetools/commercetools-php-sdk/commit/cfbc0bb)), closes [#156](https://github.com/commercetools/commercetools-php-sdk/issues/156)
* **ImportOrder:** add custom fields to ImportOrder ([008702f](https://github.com/commercetools/commercetools-php-sdk/commit/008702f))
* **Order:** add order delete request ([5944de7](https://github.com/commercetools/commercetools-php-sdk/commit/5944de7))


### BREAKING CHANGES

* added PriceDraft to price update actions

  The new PriceDraft object has been added as type hint to ProductAddPriceAction and ProductChangePriceAction. The ProductVariantDraft expects now a PriceDraftCollection


<a name="1.0.0-RC7"></a>
# [1.0.0-RC7](https://github.com/commercetools/commercetools-php-sdk/compare/v1.0.0-RC5...v1.0.0-RC7) (2015-10-19)


### Bug Fixes

* **Cart:** add corrected cart discount fields ([b0bf1b7](https://github.com/commercetools/commercetools-php-sdk/commit/b0bf1b7))
* **LocalizedString:** fix array conversion of locales for LocalizedString ([ea50790](https://github.com/commercetools/commercetools-php-sdk/commit/ea50790))
* **PaymentInfo** correct class path ([a9501fc](https://github.com/commercetools/commercetools-php-sdk/commit/a9501fc))

### Features

* **JsonObject:** recurse toArray method to child objects ([feb3729](https://github.com/commercetools/commercetools-php-sdk/commit/feb3729))

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
  ([b0bf1b7](https://github.com/commercetools/commercetools-php-sdk/commit/b0bf1b7))

<a name="1.0.0-RC5"></a>
# [1.0.0-RC5](https://github.com/commercetools/commercetools-php-sdk/compare/v1.0.0-RC4...v1.0.0-RC5) (2015-10-07)


### Features

* **LineItems:** add update actions for custom types on line items ([c64fad0](https://github.com/commercetools/commercetools-php-sdk/commit/c64fad0))
* **Payment:** add payment info to cart and order ([e279d1a](https://github.com/commercetools/commercetools-php-sdk/commit/e279d1a))
* **Payment:** add payment update actions for cart and order ([13e1860](https://github.com/commercetools/commercetools-php-sdk/commit/13e1860))



<a name="1.0.0-RC4"></a>
# [1.0.0-RC4](https://github.com/commercetools/commercetools-php-sdk/compare/v1.0.0-RC3...v1.0.0-RC4) (2015-10-05)


### Bug Fixes

* **Cart:** fix addCustomLineItem update action ([b2d704f](https://github.com/commercetools/commercetools-php-sdk/commit/b2d704f)), closes [#154](https://github.com/commercetools/commercetools-php-sdk/issues/154)
* **CustomTypes:** update to breaking changes of the API ([5e23104](https://github.com/commercetools/commercetools-php-sdk/commit/5e23104))
* **Product:** fix type for remove price action ([c0a5ccc](https://github.com/commercetools/commercetools-php-sdk/commit/c0a5ccc)), closes [#153](https://github.com/commercetools/commercetools-php-sdk/issues/153)

### Features

* **Order:** add state to order ([3a6cc3d](https://github.com/commercetools/commercetools-php-sdk/commit/3a6cc3d))
* **Payment:** add payment messages ([b9308c1](https://github.com/commercetools/commercetools-php-sdk/commit/b9308c1))
* **Payment:** add payment requests and models ([c720eed](https://github.com/commercetools/commercetools-php-sdk/commit/c720eed))
* **Product:** add state to product ([95437d8](https://github.com/commercetools/commercetools-php-sdk/commit/95437d8))
* **ProductSearch:** add fuzzy flag to product search request ([0ed8dc8](https://github.com/commercetools/commercetools-php-sdk/commit/0ed8dc8))
* **Review:** add state to review ([8278313](https://github.com/commercetools/commercetools-php-sdk/commit/8278313))


### BREAKING CHANGES

* update actions for changing the order of custom fields have been changed


<a name="1.0.0-RC3"></a>
# [1.0.0-RC3](https://github.com/commercetools/commercetools-php-sdk/compare/v1.0.0-RC2...v1.0.0-RC3) (2015-09-10)


### Bug Fixes

* **Comment:** delete comment endpoint functionality ([506644c](https://github.com/commercetools/commercetools-php-sdk/commit/506644c))
* **OAuthManager:** don't expose api credentials through exception callstack ([f0caaa1](https://github.com/commercetools/commercetools-php-sdk/commit/f0caaa1))
* **ProductDraft:** use ProductVariantDraftCollection for variants ([f252a2d](https://github.com/commercetools/commercetools-php-sdk/commit/f252a2d)), closes [#142](https://github.com/commercetools/commercetools-php-sdk/issues/142)

### Features

* **CustomFields:** add custom field models and mapping by type field definitions ([146ee40](https://github.com/commercetools/commercetools-php-sdk/commit/146ee40)) closes [#119](https://github.com/commercetools/commercetools-php-sdk/issues/119)
* **Message:** add specific message objects ([353b5ab](https://github.com/commercetools/commercetools-php-sdk/commit/353b5ab)) closes [#128](https://github.com/commercetools/commercetools-php-sdk/issues/128)
* **Orders:** add cart field to order ([922d812](https://github.com/commercetools/commercetools-php-sdk/commit/922d812)), closes [#132](https://github.com/commercetools/commercetools-php-sdk/issues/132) [#131](https://github.com/commercetools/commercetools-php-sdk/issues/131)
* **ProductSearch:** add reference expansion to product search request ([c003de6](https://github.com/commercetools/commercetools-php-sdk/commit/c003de6)), closes [#144](https://github.com/commercetools/commercetools-php-sdk/issues/144)
* **ProductVariant:** add helper methods to get variant by id ([f2ff1d4](https://github.com/commercetools/commercetools-php-sdk/commit/f2ff1d4))
* **Products:** add getBySku method ([ab9a0b9](https://github.com/commercetools/commercetools-php-sdk/commit/ab9a0b9))
* **Products:** add support to set EnumType and LocalizedEnumType attributes by key ([df88267](https://github.com/commercetools/commercetools-php-sdk/commit/df88267))
* **Products:** add support to set EnumType and LocalizedEnumType attributes by key in all variants ([e07cad6](https://github.com/commercetools/commercetools-php-sdk/commit/e07cad6))
* **QueryRequest:** add page request interface ([ecc5666](https://github.com/commercetools/commercetools-php-sdk/commit/ecc5666))
* **QueryRequest:** add sort and query request interfaces ([d19c127](https://github.com/commercetools/commercetools-php-sdk/commit/d19c127))
* **QueryRequest:** add with total request interface ([c1059ee](https://github.com/commercetools/commercetools-php-sdk/commit/c1059ee))
* **RedisCacheAdapter:** unify life time ([7b73d30](https://github.com/commercetools/commercetools-php-sdk/commit/7b73d30))
* **Reviews:** add review delete request ([2c6493e](https://github.com/commercetools/commercetools-php-sdk/commit/2c6493e)), closes [#134](https://github.com/commercetools/commercetools-php-sdk/issues/134)
* **ShippingMethod:** add getByName and getById to ShippingMethodCollection ([2de7668](https://github.com/commercetools/commercetools-php-sdk/commit/2de7668))
* **UpdateActions:** add limit to update actions ([3f728a5](https://github.com/commercetools/commercetools-php-sdk/commit/3f728a5))
* **CategoryCollection:** add getByParent and getRoots to CategoryCollection ([ece9d87](https://github.com/commercetools/commercetools-php-sdk/commit/ece9d87))
* **LocalizedString:** add support for locales to LocalizedString ([ea5e1c6](https://github.com/commercetools/commercetools-php-sdk/commit/ea5e1c6))
* **Image:** return empty thumb image url if no url is set ([a4be01b](https://github.com/commercetools/commercetools-php-sdk/commit/a4be01b))


### BREAKING CHANGES

* comments endpoint has been removed from the API

  All models and request objects have been removed from the SDK


<a name"1.0.0-RC2"></a>
# 1.0.0-RC2 (2015-08-03)


### Bug Fixes

* **ProductVariantDraft:** add images definition ([971cfbf4](https://github.com/commercetools/commercetools-php-sdk/commit/971cfbf4), closes [#135](https://github.com/commercetools/commercetools-php-sdk/issues/135))


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

 ([813a6cb7](https://github.com/commercetools/commercetools-php-sdk/commit/813a6cb7))
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

 ([4bc9575f](https://github.com/commercetools/commercetools-php-sdk/commit/4bc9575f))


<a name"1.0.0-RC1"></a>
# 1.0.0-RC1 (2015-07-27)


### Bug Fixes

* **CustomerCreateRequest:** set correct return object class ([d1c100c9](https://github.com/commercetools/sphere-php-sdk/commit/d1c100c9), closes [#109](https://github.com/commercetools/sphere-php-sdk/issues/109))
* **Requests:** fix the usage of relative path by requests ([e32d0150](https://github.com/commercetools/sphere-php-sdk/commit/e32d0150))
* **Order:** set correct return type for order discountCodes ([5bbf4f14](https://github.com/commercetools/sphere-php-sdk/commit/5bbf4f14))


### Features

* **AnnotationGenerator:** add magic method getAt and current with correct type hint to collections ([324886db](https://github.com/commercetools/sphere-php-sdk/commit/324886db))
* **Attribute:** add feature to set attribute type definitions to attributes ([37546b33](https://github.com/commercetools/sphere-php-sdk/commit/37546b33))
* **AttributeCollection:** add feature to set attribute type definitions to attribute collection ([af3b558a](https://github.com/commercetools/sphere-php-sdk/commit/af3b558a))
* **CartDiscount:** add update actions ([c0e27dd5](https://github.com/commercetools/sphere-php-sdk/commit/c0e27dd5))
* **Channel:**
  * add product distribution channel to line items and channel roles ([fdc4ed82](https://github.com/commercetools/sphere-php-sdk/commit/fdc4ed82), closes [#120](https://github.com/commercetools/sphere-php-sdk/issues/120))
  * add update actions ([b355e9aa](https://github.com/commercetools/sphere-php-sdk/commit/b355e9aa))
* **Client:** add named constructor to Client and Config object ([1a0c350f](https://github.com/commercetools/sphere-php-sdk/commit/1a0c350f), closes [#101](https://github.com/commercetools/sphere-php-sdk/issues/101))
* **Comments:** add update actions ([54804bf1](https://github.com/commercetools/sphere-php-sdk/commit/54804bf1))
* **CustomerGroups:** add update actions ([30789b76](https://github.com/commercetools/sphere-php-sdk/commit/30789b76))
* **DiscountCodes:** add update actions ([e3357965](https://github.com/commercetools/sphere-php-sdk/commit/e3357965))
* **Exceptions:** wrap http client exceptions ([a169611b](https://github.com/commercetools/sphere-php-sdk/commit/a169611b))
* **Inventory:** add update actions ([12ea56d5](https://github.com/commercetools/sphere-php-sdk/commit/12ea56d5))
* **JsonObject:** add magic getter to access object data as property ([7a22cfa7](https://github.com/commercetools/sphere-php-sdk/commit/7a22cfa7))
* **ProductDiscounts:** add update actions ([24bd9afb](https://github.com/commercetools/sphere-php-sdk/commit/24bd9afb))
* **ProductTypes:** add update actions ([50616ef8](https://github.com/commercetools/sphere-php-sdk/commit/50616ef8))
* **Project:** add project fetch request ([4e8d232c](https://github.com/commercetools/sphere-php-sdk/commit/4e8d232c), closes [#35](https://github.com/commercetools/sphere-php-sdk/issues/35))
* **Requests:**
  * add executeWithClient and mapResponse function with correct type hints ([8cb1b2cc](https://github.com/commercetools/sphere-php-sdk/commit/8cb1b2cc))
  * add withTotal flag for query speed optimization ([b7892401](https://github.com/commercetools/sphere-php-sdk/commit/b7892401))
* **Review:** add update actions ([4f1d55c8](https://github.com/commercetools/sphere-php-sdk/commit/4f1d55c8))
* **ShippingMethod:**
  * add update actions ([46993be2](https://github.com/commercetools/sphere-php-sdk/commit/46993be2))
  * add shipping method getByCartId and getByLocation ([cb522923](https://github.com/commercetools/sphere-php-sdk/commit/cb522923))
* **State:** add update actions ([3833ad1d](https://github.com/commercetools/sphere-php-sdk/commit/3833ad1d))
* **TaxCategory:** add update actions ([428ba25a](https://github.com/commercetools/sphere-php-sdk/commit/428ba25a))
* **Zones:** add update actions ([a74c3517](https://github.com/commercetools/sphere-php-sdk/commit/a74c3517))


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

 ([8de23283](https://github.com/commercetools/sphere-php-sdk/commit/8de23283))
* SingleResourceResponse renamed to ResourceResponse

  To streamline the naming schemes between the SDKs SingleResourceResponse has been renamed to ResourceResponse

 ([4199c815](https://github.com/commercetools/sphere-php-sdk/commit/4199c815))
* ImportLineItem renamed to LineItemImportDraft

  To streamline the naming schemes between the SDKs ImportProductVariant, ImportLineItem and ImportLineItemCollection
  have been renamed to ProductVariantImportDraft, LineItemImportDraft and LineItemImportDraftCollection.

 ([018c7493](https://github.com/commercetools/sphere-php-sdk/commit/018c7493))
* CartDiscountCodeReference renamed to DiscountCodeInfo

  To streamline the naming schemes between the SDKs CartDiscountCodeReference has been renamed to DiscountCodeInfo

 ([db14db07](https://github.com/commercetools/sphere-php-sdk/commit/db14db07))
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

  ([896e95a9](https://github.com/commercetools/sphere-php-sdk/commit/896e95a9))
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

  ([d601dcfc](https://github.com/commercetools/sphere-php-sdk/commit/d601dcfc))
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

  ([5704fa3e](https://github.com/commercetools/sphere-php-sdk/commit/5704fa3e))
* ProductSearchEndpoint has been renamed

  Before:

  ```
  $endpoint = ProductSearchEndpoint::endpoint();
  ```

  After:

  ```
  $endpoint = ProductProjectionEndpoint::endpoint();
  ```

  closes [#103](https://github.com/commercetools/sphere-php-sdk/issues/103)

  ([e1b6989f](https://github.com/commercetools/sphere-php-sdk/commit/e1b6989f))
* ProductsSearchRequest has been renamed

  Before:

  ```
  $request = ProductsSearchRequest::of();
  ```

  After:

  ```
  $request = ProductProjectionSearchRequest::of();
  ```

  closes [#103](https://github.com/commercetools/sphere-php-sdk/issues/103)

  ([bd1bf7b1](https://github.com/commercetools/sphere-php-sdk/commit/bd1bf7b1))
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

  closes [#101](https://github.com/commercetools/sphere-php-sdk/issues/101)

  ([1a0c350f](https://github.com/commercetools/sphere-php-sdk/commit/1a0c350f))
* ext-intl is now mandatory

  ([2afea8ad](https://github.com/commercetools/sphere-php-sdk/commit/2afea8ad))
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

  Closes [#113](https://github.com/commercetools/sphere-php-sdk/issues/113)

  ([8b138e7b](https://github.com/commercetools/sphere-php-sdk/commit/8b138e7b))
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

 ([a169611b](https://github.com/commercetools/sphere-php-sdk/commit/a169611b))
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

  ([51da11fa](https://github.com/commercetools/sphere-php-sdk/commit/51da11fa))
* changes the static "of" constructor to named constructors

  The static constructor "of" for models and requests needs magic methods in the class header to provide proper IDE support. By using the library as a dependency the magic methods were not correctly used by the IDE. Also the reflection used inside the OfTrait is not the best solution. So now all models and requests should have one or more named constructors which can be properly read by most IDE, don't require reflection for instantiation and can create instances without parameters which is helpful for testing purposes.

  * constructor of Models and Requests doesn't have required values anymore
  * static "of" constructor instantiates class with given context object. Use named constructors for instantiating models or requests with arguments

  ([d19a83c1](https://github.com/commercetools/sphere-php-sdk/commit/d19a83c1))

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
