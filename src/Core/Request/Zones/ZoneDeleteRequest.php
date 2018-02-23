<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Zones;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Zones
 * @link https://docs.commercetools.com/http-api-projects-zones.html#delete-zone
 * @method Zone mapResponse(ApiResponseInterface $response)
 * @method Zone mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ZoneDeleteRequest extends AbstractDeleteRequest
{
    protected $resultClass = Zone::class;

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(ZonesEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, $context);
    }
}
