<?php
/**
 */

namespace Commercetools\Core\Model\ApiClient;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\ApiClient
 * @method ApiClientCollection add(ApiClient $element)
 * @method ApiClient current()
 * @method ApiClient getAt($offset)
 * @method ApiClient getById($offset)
 */
class ApiClientCollection extends Collection
{
    protected $type = ApiClient::class;
}
