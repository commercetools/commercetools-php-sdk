<?php

namespace Commercetools\Core\Model\Project;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LastModifiedBy;
use DateTime;

/**
 * @package Commercetools\Core\Model\Project
 * @link https://docs.commercetools.com/api/projects/project#search-indexing-configuration
 * @method string getStatus()
 * @method SearchIndexingConfigurationValues setStatus(string $status = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method SearchIndexingConfigurationValues setLastModifiedAt(DateTime $lastModifiedAt = null)
 * @method LastModifiedBy getLastModifiedBy()
 * @method SearchIndexingConfigurationValues setLastModifiedBy(LastModifiedBy $lastModifiedBy = null)
 */
class SearchIndexingConfigurationValues extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'status' => [static::TYPE => 'string', static::OPTIONAL => true],
            'lastModifiedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'lastModifiedBy' => [static::TYPE => LastModifiedBy::class, static::OPTIONAL => true],
        ];
    }
}
