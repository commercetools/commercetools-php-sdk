<?php
/**
 */

namespace Commercetools\Core\Request\Extensions;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\Extension\Extension;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Extensions
 * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#get-an-extension-by-id
 * @method Extension mapResponse(ApiResponseInterface $response)
 * @method Extension mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ExtensionByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = Extension::class;

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(ExtensionsEndpoint::endpoint(), $id, $context);
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
