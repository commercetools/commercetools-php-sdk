<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 18:14
 */

namespace Sphere\Core\Request\Categories;


use Sphere\Core\Model\Type\CategoryReference;
use Sphere\Core\Model\Type\LocalizedString;
use Sphere\Core\Request\AbstractUpdateRequest;

/**
 * Class CategoryUpdateRequest
 * @package Sphere\Core\Request\Categories
 * @method static CategoryDeleteByIdRequest of(string $id, int $version, array $actions = [])
 */
class CategoryUpdateRequest extends AbstractUpdateRequest
{
    const NAME = 'name';
    const SLUG = 'slug';
    const DESCRIPTION = 'description';
    const PARENT = 'parent';
    const ORDER_HINT = 'orderHint';
    const EXTERNAL_ID = 'externalId';

    const CHANGE_NAME = 'changeName';
    const CHANGE_SLUG = 'changeSlug';
    const SET_DESCRIPTION = 'setDescription';
    const CHANGE_PARENT = 'changeParent';
    const CHANGE_ORDER_HINT = 'changeOrderHint';
    const SET_EXTERNAL_ID = 'setExternalId';

    /**
     * @param string $id
     * @param int $version
     * @param array $actions
     */
    public function __construct($id, $version, array $actions = [])
    {
        parent::__construct(CategoriesEndpoint::endpoint(), $id, $version, $actions);
    }

    /**
     * @param LocalizedString $name
     * @return $this
     */
    public function changeName(LocalizedString $name)
    {
        $this->addAction(
            [
                'action' => static::CHANGE_NAME,
                static::NAME => $name
            ]
        );

        return $this;
    }

    /**
     * @param LocalizedString $name
     * @return $this
     */
    public function changeSlug(LocalizedString $name)
    {
        $this->addAction(
            [
                'action' => static::CHANGE_SLUG,
                static::SLUG => $name
            ]
        );

        return $this;
    }

    /**
     * @param LocalizedString $description
     * @return $this
     */
    public function setDescription(LocalizedString $description)
    {
        $this->addAction(
            [
                'action' => static::SET_DESCRIPTION,
                static::DESCRIPTION => $description
            ]
        );

        return $this;
    }

    /**
     * @param CategoryReference $parent
     * @return $this
     */
    public function changeParent(CategoryReference $parent)
    {
        $this->addAction(
            [
                'action' => static::CHANGE_PARENT,
                static::PARENT => $parent
            ]
        );

        return $this;
    }

    /**
     * @param string $orderHint
     * @return $this
     */
    public function changeOrderHint($orderHint)
    {
        $this->addAction(
            [
                'action' => static::CHANGE_ORDER_HINT,
                static::ORDER_HINT => $orderHint
            ]
        );

        return $this;
    }

    /**
     * @param string $setExternalId
     * @return $this
     */
    public function setExternalId($setExternalId)
    {
        $this->addAction(
            [
                'action' => static::SET_EXTERNAL_ID,
                static::EXTERNAL_ID => $setExternalId
            ]
        );

        return $this;
    }
}
