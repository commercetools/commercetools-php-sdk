<?php
/**
 */

namespace Commercetools\Core\Request\Extensions;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Extension\Extension;
use Commercetools\Core\Model\Extension\ExtensionDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Extensions
 * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#create-an-extension
 * @method Extension mapResponse(ApiResponseInterface $response)
 * @method Extension mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class ExtensionCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = Extension::class;

    /**
     * @param ExtensionDraft $extension
     * @param Context $context
     */
    public function __construct(ExtensionDraft $extension, Context $context = null)
    {
        parent::__construct(ExtensionsEndpoint::endpoint(), $extension, $context);
    }

    /**
     * @param ExtensionDraft $extension
     * @param Context $context
     * @return static
     */
    public static function ofDraft(ExtensionDraft $extension, Context $context = null)
    {
        return new static($extension, $context);
    }
}
