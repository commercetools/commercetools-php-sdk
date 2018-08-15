<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Extensions\ExtensionByIdGetRequest;
use Commercetools\Core\Request\Extensions\ExtensionByKeyGetRequest;
use Commercetools\Core\Request\Extensions\ExtensionCreateRequest;
use Commercetools\Core\Model\Extension\ExtensionDraft;
use Commercetools\Core\Request\Extensions\ExtensionDeleteByKeyRequest;
use Commercetools\Core\Model\Extension\Extension;
use Commercetools\Core\Request\Extensions\ExtensionDeleteRequest;
use Commercetools\Core\Request\Extensions\ExtensionQueryRequest;
use Commercetools\Core\Request\Extensions\ExtensionUpdateByKeyRequest;
use Commercetools\Core\Request\Extensions\ExtensionUpdateRequest;

class ExtensionRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#get-an-extension-by-id
     * @param string $id
     * @return ExtensionByIdGetRequest
     */
    public function getById($id)
    {
        $request = ExtensionByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     *
     * @param string $key
     * @return ExtensionByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = ExtensionByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#create-an-extension
     * @param ExtensionDraft $extension
     * @return ExtensionCreateRequest
     */
    public function create(ExtensionDraft $extension)
    {
        $request = ExtensionCreateRequest::ofDraft($extension);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#delete-extension-by-key
     * @param Extension $extension
     * @return ExtensionDeleteByKeyRequest
     */
    public function deleteByKey(Extension $extension)
    {
        $request = ExtensionDeleteByKeyRequest::ofKeyAndVersion($extension->getKey(), $extension->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#delete-extension-by-id
     * @param Extension $extension
     * @return ExtensionDeleteRequest
     */
    public function delete(Extension $extension)
    {
        $request = ExtensionDeleteRequest::ofIdAndVersion($extension->getId(), $extension->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#query-extensions
     *
     * @return ExtensionQueryRequest
     */
    public function query()
    {
        $request = ExtensionQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#update-extension-by-key
     * @param Extension $extension
     * @return ExtensionUpdateByKeyRequest
     */
    public function updateByKey(Extension $extension)
    {
        $request = ExtensionUpdateByKeyRequest::ofKeyAndVersion($extension->getKey(), $extension->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#update-extension-by-id
     * @param Extension $extension
     * @return ExtensionUpdateRequest
     */
    public function update(Extension $extension)
    {
        $request = ExtensionUpdateRequest::ofIdAndVersion($extension->getId(), $extension->getVersion());
        return $request;
    }

    /**
     * @return ExtensionRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
