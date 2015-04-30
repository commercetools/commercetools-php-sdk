<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Zones;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class ZonesQueryRequest
 * @package Sphere\Core\Request\Zones
 * @link http://dev.sphere.io/http-api-projects-zones.html#zones-by-query
 */
class ZonesQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\Zone\ZoneCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ZonesEndpoint::endpoint(), $context);
    }
}
