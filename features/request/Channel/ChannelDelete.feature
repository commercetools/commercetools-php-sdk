Feature: I want to delete a channel
  Scenario: Delete channel
    Given a "channel" is identified by "id" and "version"
    And i want to delete a "channel"
    Then the path should be "/channels/id?version=version"
    And the method should be "DELETE"
