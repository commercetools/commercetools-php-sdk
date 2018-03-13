<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Channels;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Channels
 * @link https://docs.commercetools.com/http-api-projects-channels.html#get-channel-by-id
 * @method Channel mapResponse(ApiResponseInterface $response)
 * @method Channel mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ChannelByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = Channel::class;

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
