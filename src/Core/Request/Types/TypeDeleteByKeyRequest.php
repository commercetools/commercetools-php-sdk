<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteByKeyRequest;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Types
 * @link https://docs.commercetools.com/http-api-projects-types.html#delete-type-by-key
 * @method Type mapResponse(ApiResponseInterface $response)
 * @method Type mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class TypeDeleteByKeyRequest extends AbstractDeleteByKeyRequest
{
    protected $resultClass = Type::class;

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     */
    public function __construct($key, $version, Context $context = null)
    {
        parent::__construct(TypesEndpoint::endpoint(), $key, $version, $context);
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
