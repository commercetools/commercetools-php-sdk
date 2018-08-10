<?php

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\Types\TypeByIdGetRequest;
use Commercetools\Core\Request\Types\TypeByKeyGetRequest;
use Commercetools\Core\Request\Types\TypeCreateRequest;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\Request\Types\TypeDeleteByKeyRequest;
use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Request\Types\TypeDeleteRequest;
use Commercetools\Core\Request\Types\TypeQueryRequest;
use Commercetools\Core\Request\Types\TypeUpdateByKeyRequest;
use Commercetools\Core\Request\Types\TypeUpdateRequest;

class TypeRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#get-type-by-id
     * @param string $id
     * @return TypeByIdGetRequest
     */
    public function getById($id)
    {
        $request = TypeByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     *
     * @param string $key
     * @return TypeByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = TypeByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#create-type
     * @param TypeDraft $type
     * @return TypeCreateRequest
     */
    public function create(TypeDraft $type)
    {
        $request = TypeCreateRequest::ofDraft($type);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#delete-type-by-key
     * @param Type $type
     * @return TypeDeleteByKeyRequest
     */
    public function deleteByKey(Type $type)
    {
        $request = TypeDeleteByKeyRequest::ofKeyAndVersion($type->getKey(), $type->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#delete-type-by-id
     * @param Type $type
     * @return TypeDeleteRequest
     */
    public function delete(Type $type)
    {
        $request = TypeDeleteRequest::ofIdAndVersion($type->getId(), $type->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#query-types
     * @param 
     * @return TypeQueryRequest
     */
    public function query()
    {
        $request = TypeQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#update-type-by-key
     * @param Type $type
     * @return TypeUpdateByKeyRequest
     */
    public function updateByKey(Type $type)
    {
        $request = TypeUpdateByKeyRequest::ofKeyAndVersion($type->getKey(), $type->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-types.html#update-type-by-id
     * @param Type $type
     * @return TypeUpdateRequest
     */
    public function update(Type $type)
    {
        $request = TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion());
        return $request;
    }

    /**
     * @return TypeRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
