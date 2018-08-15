<?php
/**
 */

namespace Commercetools\Core\Request\Extensions;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Extension\Extension;
use Commercetools\Core\Request\AbstractDeleteByKeyRequest;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Extensions
 * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#delete-extension-by-key
 * @method Extension mapResponse(ApiResponseInterface $response)
 * @method Extension mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ExtensionDeleteByKeyRequest extends AbstractDeleteByKeyRequest
{
    protected $resultClass = Extension::class;

    /**
     * @param string $key
     * @param int $version
     * @param Context $context
     */
    public function __construct($key, $version, Context $context = null)
    {
        parent::__construct(ExtensionsEndpoint::endpoint(), $key, $version, $context);
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
