<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Channels;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractByIdGetRequest;
use Sphere\Core\Model\Channel\Channel;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\Channels
 * @apidoc http://dev.sphere.io/http-api-projects-channels.html#channel-by-id
 * @method Channel mapResponse(ApiResponseInterface $response)
 */
class ChannelByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = '\Sphere\Core\Model\Channel\Channel';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(ChannelsEndpoint::endpoint(), $id, $context);
    }

    /**
     * @param string $id
     * @param Context $context
     * @return static
     */
    public static function ofId($id, Context $context = null)
    {
        return new static($id, $context);
    }
}