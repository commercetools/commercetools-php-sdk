<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Channels;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractUpdateRequest;

/**
 * Class ChannelUpdateRequest
 * @package Sphere\Core\Request\Channels
 * @link http://dev.sphere.io/http-api-projects-channels.html#update-channel
 */
class ChannelUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = '\Sphere\Core\Model\Common\JsonObject';

    /**
     * @param string $id
     * @param string $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(ChannelsEndpoint::endpoint(), $id, $version, $actions, $context);
    }
}
