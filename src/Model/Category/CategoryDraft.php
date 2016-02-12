<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 27.01.15, 10:51
 */

namespace Commercetools\Core\Model\Category;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Model\CustomField\CustomFieldObjectDraft;

/**
 * @package Commercetools\Core\Model\Category
 * @link http://dev.commercetools.com/http-api-projects-categories.html#create-category
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
 * @method CustomFieldObjectDraft getCustom()
 * @method CategoryDraft setCustom(CustomFieldObjectDraft $custom = null)
 */
class CategoryDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'name' => [static::TYPE => 'Commercetools\Core\Model\Common\LocalizedString'],
            'slug' => [static::TYPE => 'Commercetools\Core\Model\Common\LocalizedString'],
            'description' => [static::TYPE => 'Commercetools\Core\Model\Common\LocalizedString'],
            'parent' => [static::TYPE => '\Commercetools\Core\Model\Category\CategoryReference'],
            'orderHint' => [static::TYPE => 'string'],
            'externalId' => [static::TYPE => 'string'],
            'custom' => [static::TYPE => '\Commercetools\Core\Model\CustomField\CustomFieldObjectDraft'],
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
