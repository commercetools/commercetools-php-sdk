<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Builder;

use Commercetools\Core\Model\Type\Type;
use Commercetools\Core\Model\Type\TypeDraft;
use Commercetools\Core\Request\Types\TypeByIdGetRequest;
use Commercetools\Core\Request\Types\TypeByKeyGetRequest;
use Commercetools\Core\Request\Types\TypeCreateRequest;
use Commercetools\Core\Request\Types\TypeDeleteRequest;
use Commercetools\Core\Request\Types\TypeQueryRequest;
use Commercetools\Core\Request\Types\TypeUpdateRequest;

class TypeRequestBuilder
{
    /**
     * @return TypeQueryRequest
     */
    public function query()
    {
        return TypeQueryRequest::of();
    }

    /**
     * @param Type $type
     * @return TypeUpdateRequest
     */
    public function update(Type $type)
    {
        return TypeUpdateRequest::ofIdAndVersion($type->getId(), $type->getVersion());
    }

    /**
     * @param TypeDraft $typeDraft
     * @return TypeCreateRequest
     */
    public function create(TypeDraft $typeDraft)
    {
        return TypeCreateRequest::ofDraft($typeDraft);
    }

    /**
     * @param Type $type
     * @return TypeDeleteRequest
     */
    public function delete(Type $type)
    {
        return TypeDeleteRequest::ofIdAndVersion($type->getId(), $type->getVersion());
    }

    /**
     * @param $id
     * @return TypeByIdGetRequest
     */
    public function getById($id)
    {
        return TypeByIdGetRequest::ofId($id);
    }

    /**
     * @param $key
     * @return TypeByKeyGetRequest
     */
    public function getByKey($key)
    {
        return TypeByKeyGetRequest::ofKey($key);
    }
}
