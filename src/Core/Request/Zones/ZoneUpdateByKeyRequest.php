<?php
/**
 */

namespace Commercetools\Core\Request\Zones;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Request\AbstractUpdateByKeyRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Zones
 * @link https://docs.commercetools.com/http-api-projects-zones.html#update-zone-by-key
 * @method Zone mapResponse(ApiResponseInterface $response)
 * @method Zone mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ZoneUpdateByKeyRequest extends AbstractUpdateByKeyRequest
{
    protected $resultClass = Zone::class;

    /**
     * @param string $key
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($key, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(ZonesEndpoint::endpoint(), $key, $version, $actions, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, [], $context);
    }
}
