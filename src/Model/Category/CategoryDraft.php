<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 10:51
 */

namespace Sphere\Core\Model\Category;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;

/**
 * @package Sphere\Core\Model\Category
 * @apidoc http://dev.sphere.io/http-api-projects-categories.html#create-category
 * @method LocalizedString getName()
 * @method LocalizedString getSlug()
 * @method LocalizedString getDescription()
 * @method CategoryReference getParent()
 * @method string getOrderHint()
 * @method string getExternalId()
 * @method CategoryDraft setName(LocalizedString $name = null)
 * @method CategoryDraft setSlug(LocalizedString $slug = null)
 * @method CategoryDraft setDescription(LocalizedString $description = null)
 * @method CategoryDraft setParent(CategoryReference $parent = null)
 * @method CategoryDraft setOrderHint(string $orderHint = null)
 * @method CategoryDraft setExternalId(string $externalId = null)
 */
class CategoryDraft extends JsonObject
{
    public function getFields()
    {
        return [
            'name' => [self::TYPE => 'Sphere\Core\Model\Common\LocalizedString'],
            'slug' => [self::TYPE => 'Sphere\Core\Model\Common\LocalizedString'],
            'description' => [self::TYPE => 'Sphere\Core\Model\Common\LocalizedString'],
            'parent' => [self::TYPE => '\Sphere\Core\Model\Category\CategoryReference'],
            'orderHint' => [self::TYPE => 'string'],
            'externalId' => [self::TYPE => 'string'],
        ];
    }

    /**
     * @param LocalizedString $name
     * @param LocalizedString $slug
     * @param Context|callable $context
     * @return CategoryDraft
     */
    public static function ofNameAndSlug(LocalizedString $name, LocalizedString $slug, $context = null)
    {
        $draft = static::of($context);
        return $draft->setName($name)->setSlug($slug);
    }
}
