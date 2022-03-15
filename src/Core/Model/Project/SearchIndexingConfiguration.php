<?php

namespace Commercetools\Core\Model\Project;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Project
 * @link https://docs.commercetools.com/api/projects/project#search-indexing-configuration
 * @method SearchIndexingConfigurationValues getProducts()
 * @method SearchIndexingConfiguration setProducts(SearchIndexingConfigurationValues $products = null)
 * @method SearchIndexingConfigurationValues getOrders()
 * @method SearchIndexingConfiguration setOrders(SearchIndexingConfigurationValues $orders = null)
 */
class SearchIndexingConfiguration extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'products' => [static::TYPE => SearchIndexingConfigurationValues::class, static::OPTIONAL => true],
            'orders' => [static::TYPE => SearchIndexingConfigurationValues::class, static::OPTIONAL => true]
        ];
    }
}
