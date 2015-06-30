Feature: I want to delete a channel
  Scenario: Delete channel
    Given a "channel" is identified by "id" and version 1
    And i want to delete a "channel"
    Then the path should be "channels/id?version=1"
    And the method should be "DELETE"
