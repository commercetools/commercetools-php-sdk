<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\CustomObjects\CustomObjectByIdGetRequest;
use Commercetools\Core\Request\CustomObjects\CustomObjectByKeyGetRequest;
use Commercetools\Core\Request\CustomObjects\CustomObjectCreateRequest;
use Commercetools\Core\Model\CustomObject\CustomObjectDraft;
use Commercetools\Core\Request\CustomObjects\CustomObjectDeleteByKeyRequest;
use Commercetools\Core\Request\CustomObjects\CustomObjectDeleteRequest;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Request\CustomObjects\CustomObjectQueryRequest;

class CustomObjectRequestBuilder
{

    /**
     *
     * @param string $id
     * @return CustomObjectByIdGetRequest
     */
    public function getById($id)
    {
        $request = CustomObjectByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-custom-objects.html#get-customobject-by-container-and-key
     * @param string $container
     * @param string $key
     * @return CustomObjectByKeyGetRequest
     */
    public function getByContainerAndKey($container, $key)
    {
        $request = CustomObjectByKeyGetRequest::ofContainerAndKey($container, $key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-custom-objects.html#create-a-customobject
     * @param CustomObjectDraft $customObject
     * @return CustomObjectCreateRequest
     */
    public function create(CustomObjectDraft $customObject)
    {
        $request = CustomObjectCreateRequest::ofDraft($customObject);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-custom-objects.html#delete-customobject-by-container-and-key
     * @param CustomObject $customObject
     * @return CustomObjectDeleteByKeyRequest
     */
    public function deleteByContainerAndKey(CustomObject $customObject)
    {
        $request = CustomObjectDeleteByKeyRequest::ofContainerAndKey($customObject->getContainer(), $customObject->getKey());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-custom-objects.html#delete-customobject-by-id
     * @param CustomObject $customObject
     * @return CustomObjectDeleteRequest
     */
    public function delete(CustomObject $customObject)
    {
        $request = CustomObjectDeleteRequest::ofIdAndVersion($customObject->getId(), $customObject->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-custom-objects.html#query-customobjects
     *
     * @return CustomObjectQueryRequest
     */
    public function query()
    {
        $request = CustomObjectQueryRequest::of();
        return $request;
    }

    /**
     * @return CustomObjectRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
