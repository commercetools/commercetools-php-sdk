<?php
/**
 */

namespace Commercetools\Core\Request\OrderEdits;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\OrderEdit\OrderEdit;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\OrderEdits
 *
 * @method OrderEdit mapResponse(ApiResponseInterface $response)
 * @method OrderEdit mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class OrderEditByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = OrderEdit::class;

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(OrderEditsEndpoint::endpoint(), $id, $context);
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
