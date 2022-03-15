<?php

namespace Commercetools\Core\Model\OrderSearch;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\OrderSearch
 *
 * @method string getId()
 * @method Hit setId(string $id = null)
 * @method int getVersion()
 * @method Hit setVersion(int $version = null)
 * @method float getRelevance()
 * @method Hit setRelevance(float $relevance = null)
 */
class Hit extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'relevance' => [static::TYPE => 'float']
        ];
    }
}
