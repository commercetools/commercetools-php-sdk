<?php
// phpcs:disable Generic.Files.LineLength
namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\OrderEdits\OrderEditApplyRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditByIdGetRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditByKeyGetRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditCreateRequest;
use Commercetools\Core\Model\OrderEdit\OrderEditDraft;
use Commercetools\Core\Request\OrderEdits\OrderEditDeleteByKeyRequest;
use Commercetools\Core\Model\OrderEdit\OrderEdit;
use Commercetools\Core\Request\OrderEdits\OrderEditDeleteRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditQueryRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditUpdateByKeyRequest;
use Commercetools\Core\Request\OrderEdits\OrderEditUpdateRequest;

class OrderEditRequestBuilder
{

    /**
     *
     *
     * @return OrderEditApplyRequest
     */
    public function apply()
    {
        $request = OrderEditApplyRequest::of();
        return $request;
    }

    /**
     *
     * @param string $id
     * @return OrderEditByIdGetRequest
     */
    public function getById($id)
    {
        $request = OrderEditByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     *
     * @param string $key
     * @return OrderEditByKeyGetRequest
     */
    public function getByKey($key)
    {
        $request = OrderEditByKeyGetRequest::ofKey($key);
        return $request;
    }

    /**
     *
     * @param OrderEditDraft $orderEdit
     * @return OrderEditCreateRequest
     */
    public function create(OrderEditDraft $orderEdit)
    {
        $request = OrderEditCreateRequest::ofDraft($orderEdit);
        return $request;
    }

    /**
     *
     * @param OrderEdit $orderEdit
     * @return OrderEditDeleteByKeyRequest
     */
    public function deleteByKey(OrderEdit $orderEdit)
    {
        $request = OrderEditDeleteByKeyRequest::ofKeyAndVersion($orderEdit->getKey(), $orderEdit->getVersion());
        return $request;
    }

    /**
     *
     * @param OrderEdit $orderEdit
     * @return OrderEditDeleteRequest
     */
    public function delete(OrderEdit $orderEdit)
    {
        $request = OrderEditDeleteRequest::ofIdAndVersion($orderEdit->getId(), $orderEdit->getVersion());
        return $request;
    }

    /**
     *
     *
     * @return OrderEditQueryRequest
     */
    public function query()
    {
        $request = OrderEditQueryRequest::of();
        return $request;
    }

    /**
     *
     * @param OrderEdit $orderEdit
     * @return OrderEditUpdateByKeyRequest
     */
    public function updateByKey(OrderEdit $orderEdit)
    {
        $request = OrderEditUpdateByKeyRequest::ofKeyAndVersion($orderEdit->getKey(), $orderEdit->getVersion());
        return $request;
    }

    /**
     *
     * @param OrderEdit $orderEdit
     * @return OrderEditUpdateRequest
     */
    public function update(OrderEdit $orderEdit)
    {
        $request = OrderEditUpdateRequest::ofIdAndVersion($orderEdit->getId(), $orderEdit->getVersion());
        return $request;
    }

    /**
     * @return OrderEditRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
