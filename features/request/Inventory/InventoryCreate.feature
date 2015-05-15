Feature: I want to create a new inventory entry
  Background:
    Given i have a inventory draft
    And the sku is "SKU-12345"
    And the quantityInStock is 100 as int
    And set the restockableInDays to 5 as int
    And set the expectedDelivery date to "2015-05-15 12:00:00"
    And set the channel reference supplyChannel to "supply-channel-id"

  Scenario: create an inventory entry
    When i want to create a "inventory"
    Then the path should be "inventory"
    And the method should be "POST"
    And the request should be
    """
    {
      "sku": "SKU-12345",
      "quantityOnStock": 100,
      "restockableInDays": 5,
      "expectedDelivery": "2015-05-15T12:00:00+00:00",
      "supplyChannel": {
        "typeId": "channel",
        "id": "supply-channel-id"
      }
    }
    """
