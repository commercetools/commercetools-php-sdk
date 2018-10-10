<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\OrderEdit\OrderEdit;
use Commercetools\Core\Request\AbstractDeleteByKeyRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\OrderEdits
 *
 * @method OrderEdit mapResponse(ApiResponseInterface $response)
 * @method OrderEdit mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class OrderEditDeleteByKeyRequest extends AbstractDeleteByKeyRequest
{
//    use DataErasureTrait;

    protected $resultClass = OrderEdit::class;

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(OrderEditsEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofKeyAndVersion($key, $version, Context $context = null)
    {
        return new static($key, $version, $context);
    }
}
