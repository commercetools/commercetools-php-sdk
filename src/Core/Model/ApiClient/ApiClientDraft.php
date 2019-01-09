<?php
/**
 */

namespace Commercetools\Core\Model\ApiClient;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\ApiClient
 *
 * @method string getName()
 * @method ApiClientDraft setName(string $name = null)
 * @method string getScope()
 * @method ApiClientDraft setScope(string $scope = null)
 */
class ApiClientDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => 'string'],
            'scope' => [static::TYPE => 'string']
        ];
    }
}
