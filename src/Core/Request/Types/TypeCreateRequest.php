<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Types
 * @link https://docs.commercetools.com/http-api-projects-types.html#create-type
 * @method Type mapResponse(ApiResponseInterface $response)
 * @method Type mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class TypeCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = Type::class;

    /**
     * @param TypeDraft $type
     * @param Context $context
     */
    public function __construct(TypeDraft $type, Context $context = null)
    {
        parent::__construct(TypesEndpoint::endpoint(), $type, $context);
    }

    /**
     * @param TypeDraft $type
     * @param Context $context
     * @return static
     */
    public static function ofDraft(TypeDraft $type, Context $context = null)
    {
        return new static($type, $context);
    }
}
