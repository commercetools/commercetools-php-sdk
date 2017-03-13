Feature: I want to send a Product Update Request
  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "changeName" action to "product" with values
    """
        {
          "action": "changeName",
          "name": {
            "en": "newProduct"
          }
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeName",
          "name": {
            "en": "newProduct"
          }
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "setDescription" action to "product" with values
    """
        {
          "action": "setDescription",
          "description": {
            "en": "newDescription"
          }
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setDescription",
          "description": {
            "en": "newDescription"
          }
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "changeSlug" action to "product" with values
    """
        {
          "action": "changeSlug",
          "slug": {
            "en": "newSlug"
          }
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changeSlug",
          "slug": {
            "en": "newSlug"
          }
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "addVariant" action to "product" with values
    """
        {
          "action": "addVariant",
          "sku": "variantSKU"
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addVariant",
          "sku": "variantSKU"
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "addVariant" action to "product" with values
    """
        {
          "action": "addVariant",
          "sku": "variantSKU",
          "prices": [
            {
              "value": {
                "currencyCode": "EUR",
                "centAmount": 300
              },
              "country": "DE"
            }
          ]
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addVariant",
          "sku": "variantSKU",
          "prices": [
            {
              "value": {
                "currencyCode": "EUR",
                "centAmount": 300
              },
              "country": "DE"
            }
          ]
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "removeVariant" action to "product" with values
    """
        {
          "action": "removeVariant",
          "id": 1
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "removeVariant",
          "id": 1
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "setMetaTitle" action to "product" with values
    """
        {
          "action": "setMetaTitle",
          "metaTitle": {
            "en": "metaTitle"
          }
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setMetaTitle",
          "metaTitle": {
            "en": "metaTitle"
          }
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "setMetaDescription" action to "product" with values
    """
        {
          "action": "setMetaDescription",
          "metaDescription": {
            "en": "metaDescription"
          }
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setMetaDescription",
          "metaDescription": {
            "en": "metaDescription"
          }
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "setMetaKeywords" action to "product" with values
    """
        {
          "action": "setMetaKeywords",
          "metaKeywords": {
            "en": "metaKeywords"
          }
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setMetaKeywords",
          "metaKeywords": {
            "en": "metaKeywords"
          }
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "addPrice" action to "product" with values
    """
        {
          "action": "addPrice",
          "variantId": 1,
          "price": {
            "value": {
              "currencyCode": "EUR",
              "centAmount": 300
            },
            "country": "DE"
          }
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addPrice",
          "variantId": 1,
          "price": {
            "value": {
              "currencyCode": "EUR",
              "centAmount": 300
            },
            "country": "DE"
          }
        }
      ]
    }
    """

  Scenario: add price with validity period
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "addPrice" action to "product" with values
    """
        {
          "action": "addPrice",
          "variantId": 1,
          "price": {
            "value": {
              "currencyCode": "EUR",
              "centAmount": 300
            },
            "country": "DE",
            "validFrom": "2015-05-15T12:00:00+00:00",
            "validUntil": "2015-05-15T13:00:00+00:00"
          }
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addPrice",
          "variantId": 1,
          "price": {
            "value": {
              "currencyCode": "EUR",
              "centAmount": 300
            },
            "country": "DE",
            "validFrom": "2015-05-15T12:00:00+00:00",
            "validUntil": "2015-05-15T13:00:00+00:00"
          }
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "changePrice" action to "product" with values
    """
        {
          "action": "changePrice",
          "priceId": 1,
          "price": {
            "value": {
              "currencyCode": "EUR",
              "centAmount": 300
            },
            "country": "DE"
          }
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "changePrice",
          "priceId": 1,
          "price": {
            "value": {
              "currencyCode": "EUR",
              "centAmount": 300
            },
            "country": "DE"
          }
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "removePrice" action to "product" with values
    """
        {
          "action": "removePrice",
          "priceId": 1
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "removePrice",
          "priceId": 1
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "setAttribute" action to "product" with values
    """
        {
          "action": "setAttribute",
          "variantId": 1,
          "name": "myAttribute",
          "value": "newValue"
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setAttribute",
          "variantId": 1,
          "name": "myAttribute",
          "value": "newValue"
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "setAttribute" action to "product" with values
    """
        {
          "action": "setAttribute",
          "variantId": 1,
          "name": "myTextAttribute",
          "value": "newValue"
        }
    """
    And add the "setAttribute" action to "product" with values
    """
        {
          "action": "setAttribute",
          "variantId": 1,
          "name": "myLocalizedStringAttribute",
          "value": {
            "en": "newValue"
          }
        }
    """
    And add the "setAttribute" action to "product" with values
    """
        {
          "action": "setAttribute",
          "variantId": 1,
          "name": "myMoneyAttribute",
          "value": {
            "centAmount": 100,
            "currency": "EUR"
          }
        }
    """
    And add the "setAttribute" action to "product" with values
    """
        {
          "action": "setAttribute",
          "variantId": 1,
          "name": "myEnumAttribute",
          "value": "key"
        }
    """
    And add the "setAttribute" action to "product" with values
    """
        {
          "action": "setAttribute",
          "variantId": 1,
          "name": "myLocalizedEnumAttribute",
          "value": {
            "key": "enumKey",
            "label": {
              "en": "Enum Key"
            }
          }
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setAttribute",
          "variantId": 1,
          "name": "myTextAttribute",
          "value": "newValue"
        },
        {
          "action": "setAttribute",
          "variantId": 1,
          "name": "myLocalizedStringAttribute",
          "value": {
            "en": "newValue"
          }
        },
        {
          "action": "setAttribute",
          "variantId": 1,
          "name": "myMoneyAttribute",
          "value": {
            "centAmount": 100,
            "currency": "EUR"
          }
        },
        {
          "action": "setAttribute",
          "variantId": 1,
          "name": "myEnumAttribute",
          "value": "key"
        },
        {
          "action": "setAttribute",
          "variantId": 1,
          "name": "myLocalizedEnumAttribute",
          "value": {
            "key": "enumKey",
            "label": {
              "en": "Enum Key"
            }
          }
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "setAttributeInAllVariants" action to "product" with values
    """
        {
          "action": "setAttributeInAllVariants",
          "name": "myAttribute",
          "value": "newValue"
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setAttributeInAllVariants",
          "name": "myAttribute",
          "value": "newValue"
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "addToCategory" action to "product" with values
    """
        {
          "action": "addToCategory",
          "category": {
            "typeId": "category",
            "id": "myCategory"
          }
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addToCategory",
          "category": {
            "typeId": "category",
            "id": "myCategory"
          }
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "removeFromCategory" action to "product" with values
    """
        {
          "action": "removeFromCategory",
          "category": {
            "typeId": "category",
            "id": "myCategory"
          }
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "removeFromCategory",
          "category": {
            "typeId": "category",
            "id": "myCategory"
          }
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "setTaxCategory" action to "product" with values
    """
        {
          "action": "setTaxCategory",
          "taxCategory": {
            "typeId": "tax-category",
            "id": "myTaxCategory"
          }
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setTaxCategory",
          "taxCategory": {
            "typeId": "tax-category",
            "id": "myTaxCategory"
          }
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "setSearchKeywords" action to "product" with values
    """
        {
          "action": "setSearchKeywords",
          "searchKeywords": {
            "en": [
              {
                "text": "Multi tool"
              },
              {
                "text": "Swiss Army Knife",
                "suggestTokenizer": {
                  "type": "whitespace"
                }
              }
            ],
            "de": [
              {
                "text": "Schweizer Messer",
                "suggestTokenizer": {
                  "type": "custom", "inputs": [
                    "schweizer messer",
                    "offiziersmesser",
                    "sackmesser"
                  ]
                }
              }
            ]
          }
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "setSearchKeywords",
          "searchKeywords": {
            "en": [
              {
                "text": "Multi tool"
              },
              {
                "text": "Swiss Army Knife",
                "suggestTokenizer": {
                  "type": "whitespace"
                }
              }
            ],
            "de": [
              {
                "text": "Schweizer Messer",
                "suggestTokenizer": {
                  "type": "custom", "inputs": [
                    "schweizer messer",
                    "offiziersmesser",
                    "sackmesser"
                  ]
                }
              }
            ]
          }
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "revertStagedChanges" action to "product" with values
    """
        {
          "action": "revertStagedChanges"
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "revertStagedChanges"
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "publish" action to "product" with values
    """
        {
          "action": "publish"
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "publish"
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "unpublish" action to "product" with values
    """
        {
          "action": "unpublish"
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "unpublish"
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "addExternalImage" action to "product" with values
    """
        {
          "action": "addExternalImage",
          "variantId": 1,
          "image": {
            "url": "http://example.org/image.jpg",
            "dimensions": {
              "w": 100,
              "h": 100
            },
            "label": "Image"
          }
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "addExternalImage",
          "variantId": 1,
          "image": {
            "url": "http://example.org/image.jpg",
            "dimensions": {
              "w": 100,
              "h": 100
            },
            "label": "Image"
          }
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "moveImageToPosition" action to "product" with values
    """
        {
          "action": "moveImageToPosition",
          "variantId": 1,
          "imageUrl": "http://example.org/image.jpg",
          "position": 3
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "moveImageToPosition",
          "variantId": 1,
          "imageUrl": "http://example.org/image.jpg",
          "position": 3
        }
      ]
    }
    """

  Scenario:
    Given a "product" is identified by "id" and version 1
    And i want to update a "product"
    And add the "removeImage" action to "product" with values
    """
        {
          "action": "removeImage",
          "variantId": 1,
          "imageUrl": "http://example.org/image.jpg"
        }
    """
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": 1,
      "actions": [
        {
          "action": "removeImage",
          "variantId": 1,
          "imageUrl": "http://example.org/image.jpg"
        }
      ]
    }
    """
