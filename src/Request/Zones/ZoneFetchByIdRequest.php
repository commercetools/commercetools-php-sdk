<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Zones;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;

/**
 * Class ZoneFetchByIdRequest
 * @package Sphere\Core\Request\Zones
 * @link http://dev.sphere.io/http-api-projects-zones.html#zone-by-id
 */
class ZoneFetchByIdRequest extends AbstractFetchByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\Zone\Zone';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(ZonesEndpoint::endpoint(), $id, $context);
    }
}
