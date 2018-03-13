<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Channels;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractUpdateRequest;
use Commercetools\Core\Model\Channel\Channel;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Channels
 * @link https://docs.commercetools.com/http-api-projects-channels.html#update-channel
 * @method Channel mapResponse(ApiResponseInterface $response)
 * @method Channel mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ChannelUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = Channel::class;

    /**
     * @param string $id
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(ChannelsEndpoint::endpoint(), $id, $version, $actions, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, [], $context);
    }
}
