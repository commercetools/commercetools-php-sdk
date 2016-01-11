<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Zones;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Zone\ZoneDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Zone\Zone;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Zones
 * @method Zone mapResponse(ApiResponseInterface $response)
 */
class ZoneCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Zone\Zone';

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
