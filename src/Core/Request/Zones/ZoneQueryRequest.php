<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Zones;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\Zone\ZoneCollection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Zones
 * @link https://docs.commercetools.com/http-api-projects-zones.html#query-zones
 * @method ZoneCollection mapResponse(ApiResponseInterface $response)
 * @method ZoneCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ZoneQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = ZoneCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ZonesEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
