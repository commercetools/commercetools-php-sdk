<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Types
 * @link https://dev.commercetools.com/http-api-projects-types.html#create-type
 * @method Type mapResponse(ApiResponseInterface $response)
 */
class TypeCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Type\Type';

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
