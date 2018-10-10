<?php
/**
 */

namespace Commercetools\Core\Request\OrderEdits;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\OrderEdit\OrderEdit;
use Commercetools\Core\Request\AbstractUpdateRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\OrderEdits
 *
 * @method OrderEdit mapResponse(ApiResponseInterface $response)
 * @method OrderEdit mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class OrderEditUpdateRequest extends AbstractUpdateRequest
{
    protected $resultClass = OrderEdit::class;

    /**
     * @param string $id
     * @param int $version
     * @param array $actions
     * @param Context $context
     */
    public function __construct($id, $version, array $actions = [], Context $context = null)
    {
        parent::__construct(OrderEditsEndpoint::endpoint(), $id, $version, $actions, $context);
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
