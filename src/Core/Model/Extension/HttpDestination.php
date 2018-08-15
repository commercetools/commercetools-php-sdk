<?php
/**
 */

namespace Commercetools\Core\Model\Extension;

/**
 * @package Commercetools\Core\Model\Extension
 *
 * @method string getType()
 * @method HttpDestination setType(string $type = null)
 * @method string getUrl()
 * @method HttpDestination setUrl(string $url = null)
 * @method HttpDestinationAuthentication getAuthentication()
 * @method HttpDestination setAuthentication(HttpDestinationAuthentication $authentication = null)
 */
class HttpDestination extends Destination
{
    const DESTINATION_TYPE = self::DESTINATION_HTTP;

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'url' => [static::TYPE => 'string'],
            'authentication' => [static::TYPE => HttpDestinationAuthentication::class]
        ];
    }
}
