<?php
/**
 */

namespace Commercetools\Core\Request\Zones;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Request\AbstractByKeyGetRequest;
use Commercetools\Core\Model\MapperInterface;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Zones
 * @link https://docs.commercetools.com/http-api-projects-zones.html#get-zone-by-key
 * @method Zone mapResponse(ApiResponseInterface $response)
 * @method Zone mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ZoneByKeyGetRequest extends AbstractByKeyGetRequest
{
    protected $resultClass = Zone::class;

    /**
     * @param string $key
     * @param Context $context
     */
    public function __construct($key, Context $context = null)
    {
        parent::__construct(ZonesEndpoint::endpoint(), $key, $context);
    }

    /**
     * @param string $key
     * @param Context $context
     * @return static
     */
    public static function ofKey($key, Context $context = null)
    {
        return new static($key, $context);
    }
}
