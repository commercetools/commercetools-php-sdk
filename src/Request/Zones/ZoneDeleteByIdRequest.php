<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Zones;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractDeleteByIdRequest;

/**
 * Class ZoneDeleteByIdRequest
 * @package Sphere\Core\Request\Zones
 * @link http://dev.sphere.io/http-api-projects-zones.html#delete-zone
 */
class ZoneDeleteByIdRequest extends AbstractDeleteByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\Zone\Zone';

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
