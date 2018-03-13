<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Model\Type\TypeCollection;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Types
 * @link https://docs.commercetools.com/http-api-projects-types.html#query-types
 * @method TypeCollection mapResponse(ApiResponseInterface $response)
 * @method TypeCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class TypeQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = TypeCollection::class;

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(TypesEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
