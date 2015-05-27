Feature: I want to send a Product Update Request
  Background:
    Given a "product" is identified by "id" and "version"
    Given i have a "common" "money" object as "money"
    And the "currency" is "EUR"
    And the "centAmount" is "300" as "int"
    Given i have a "common" "price" object as "price"
    And the "value" is "money" object
    And set the "country" to "DE"
    Given i have a "common" "priceCollection" object as "prices"
    And add the "price" object to "prices" collection

  Scenario:
    Given i want to "changeName" of "product"
    And the "name" is "newProduct" in "en"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "setDescription" of "product"
    And the "description" is "newDescription" in "en"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "changeSlug" of "product"
    And the "slug" is "newSlug" in "en"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "addVariant" of "product"
    And set the "sku" to "variantSKU"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "addVariant",
          "sku": "variantSKU"
        }
      ]
    }
    """

  Scenario:
    Given i want to "addVariant" of "product"
    And set the "sku" to "variantSKU"
    And set the "prices" object to "prices"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "removeVariant" of "product"
    And the "id" is "1" as "int"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "removeVariant",
          "id": 1
        }
      ]
    }
    """

  Scenario:
    Given i want to "setMetaAttributes" of "product"
    And set the "metaTitle" to "metaTitle" in "en"
    And set the "metaDescription" to "metaDescription" in "en"
    And set the "metaKeywords" to "metaKeywords" in "en"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setMetaAttributes",
          "metaTitle": {
            "en": "metaTitle"
          },
          "metaDescription": {
            "en": "metaDescription"
          },
          "metaKeywords": {
            "en": "metaKeywords"
          }
        }
      ]
    }
    """

  Scenario:
    Given i want to "setMetaTitle" of "product"
    And set the "metaTitle" to "metaTitle" in "en"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "setMetaDescription" of "product"
    And set the "metaDescription" to "metaDescription" in "en"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "setMetaKeywords" of "product"
    And set the "metaKeywords" to "metaKeywords" in "en"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "addPrice" of "product"
    And the "variantId" is "1" as "int"
    And the "price" is "price" object
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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

  Scenario:
    Given i want to "changePrice" of "product"
    And the "priceId" is "1" as "int"
    And the "price" is "price" object
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "removePrice" of "product"
    And the "priceId" is "1" as "int"
    And the "price" is "price" object
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "removePrice",
          "priceId": 1
        }
      ]
    }
    """

  Scenario:
    Given i want to "setAttribute" of "product"
    And the "variantId" is "1" as "int"
    And the "name" is "myAttribute"
    And set the "value" to "newValue"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "setAttributeInAllVariants" of "product"
    And the "name" is "myAttribute"
    And set the "value" to "newValue"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "addToCategory" of "product"
    And the "category" reference "category" is "myCategory"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "removeFromCategory" of "product"
    And the "category" reference "category" is "myCategory"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "setTaxCategory" of "product"
    And set the "taxCategory" reference "taxCategory" to "myTaxCategory"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "setSKU" of "product"
    And the "variantId" is "1" as "int"
    And set the "sku" to "mySKU"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "setSKU",
          "variantId": 1,
          "sku": "mySKU"
        }
      ]
    }
    """

  Scenario:
    Given i have a "product" "suggestTokenizer" object as "whitespaceTokenizer"
    And set the type to "whitespace"
    Given i have a "product" "suggestTokenizer" object as "customTokenizer"
    And set the type to "custom"
    And set the inputs to "schweizer messer, offiziersmesser, sackmesser" as "array"
    Given i have a "product" "SearchKeyword" object as "enMultiTool"
    And set the "text" to "Multi tool"
    Given i have a "product" "SearchKeyword" object as "enSwissArmyKnife"
    And set the "text" to "Swiss Army Knife"
    And set the "whitespaceTokenizer" object to "suggestTokenizer"
    Given i have a "product" "SearchKeyword" object as "deSwissArmyKnife"
    And set the "text" to "Schweizer Messer"
    And set the "customTokenizer" object to "suggestTokenizer"
    Given i have a "product" "searchKeywords" object as "enKeywords"
    And add the enMultiTool object to enKeywords collection
    And add the enSwissArmyKnife object to enKeywords collection
    Given i have a "product" "searchKeywords" object as "deKeywords"
    And add the deSwissArmyKnife object to deKeywords collection
    Given i have a "product" "localizedSearchKeywords" object as "keywords"
    And set the enKeywords object to keywords collection at "en"
    And set the deKeywords object to keywords collection at "de"
    Given i want to "setSearchKeywords" of "product"
    And the searchKeywords is keywords object
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
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
    Given i want to "revertStagedChanges" of "product"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "revertStagedChanges"
        }
      ]
    }
    """

  Scenario:
    Given i want to "publish" of "product"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "publish"
        }
      ]
    }
    """

  Scenario:
    Given i want to "unpublish" of "product"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "unpublish"
        }
      ]
    }
    """

  Scenario:
    Given i have a common imageDimension object as imageDimension
    And set the w to 100 as int
    And set the h to 100 as int
    Given i have a "common" "image" object as "extImage"
    And set the url to "http://mycompany.com/image.jpg"
    And set the label to "Image"
    And set the imageDimension object to dimensions
    Given i want to "addExternalImage" of "product"
    And the variantId is 1 as int
    And the image is extImage object
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "addExternalImage",
          "variantId": 1,
          "image": {
            "url": "http://mycompany.com/image.jpg",
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
    Given i want to "removeImage" of "product"
    And the variantId is 1 as int
    And the imageUrl is "http://mycompany.com/image.jpg"
    When i want to update a "Product"
    Then the path should be "products/id"
    And the method should be "POST"
    And the request should be
    """
    {
      "version": "version",
      "actions": [
        {
          "action": "removeImage",
          "variantId": 1,
          "imageUrl": "http://mycompany.com/image.jpg"
        }
      ]
    }
    """
