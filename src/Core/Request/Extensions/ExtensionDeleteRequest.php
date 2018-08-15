<?php
/**
 */

namespace Commercetools\Core\Request\Extensions;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Extension\Extension;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Extensions
 * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#delete-extension-by-id
 * @method Extension mapResponse(ApiResponseInterface $response)
 * @method Extension mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ExtensionDeleteRequest extends AbstractDeleteRequest
{
    protected $resultClass = Extension::class;

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(ExtensionsEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, $context);
    }
}
