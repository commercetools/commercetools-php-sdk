<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Zones;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Zone\ZoneDraft;
use Sphere\Core\Request\AbstractCreateRequest;

/**
 * Class ZoneCreateRequest
 * @package Sphere\Core\Request\Zones
 */
class ZoneCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Zone\Zone';

    /**
     * @param ZoneDraft $zone
     * @param Context $context
     */
    public function __construct(ZoneDraft $zone, Context $context = null)
    {
        parent::__construct(ZonesEndpoint::endpoint(), $zone, $context);
    }

    /**
     * @param ZoneDraft $zone
     * @param Context $context
     * @return static
     */
    public static function ofDraft(ZoneDraft $zone, Context $context = null)
    {
        return new static($zone, $context);
    }
}
