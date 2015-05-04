<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Channels;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class ChannelsQueryRequest
 * @package Sphere\Core\Request\Channels
 * @link http://dev.sphere.io/http-api-projects-channels.html#channels-by-query
 */
class ChannelsQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\Common\Collection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(ChannelsEndpoint::endpoint(), $context);
    }
}
