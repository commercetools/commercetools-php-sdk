<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Category;

use Sphere\Core\Model\Common\Document;
use Sphere\Core\Model\Common\LocalizedString;

/**
 * Class Category
 * @package Sphere\Core\Model\Category
 * @link http://dev.sphere.io/http-api-projects-categories.html#category
 * @method string getId()
 * @method Category setId(string $id = null)
 * @method int getVersion()
 * @method Category setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method Category setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method Category setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method LocalizedString getName()
 * @method Category setName(LocalizedString $name = null)
 * @method LocalizedString getSlug()
 * @method Category setSlug(LocalizedString $slug = null)
 * @method LocalizedString getDescription()
 * @method Category setDescription(LocalizedString $description = null)
 * @method CategoryReferenceCollection getAncestors()
 * @method Category setAncestors(CategoryReferenceCollection $ancestors = null)
 * @method CategoryReference getParent()
 * @method Category setParent(CategoryReference $parent = null)
 * @method string getOrderHint()
 * @method Category setOrderHint(string $orderHint = null)
 * @method string getExternalId()
 * @method Category setExternalId(string $externalId = null)
 */
class Category extends Document
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'name' => [self::TYPE => 'Sphere\Core\Model\Common\LocalizedString'],
            'slug' => [self::TYPE => 'Sphere\Core\Model\Common\LocalizedString'],
            'description' => [self::TYPE => 'Sphere\Core\Model\Common\LocalizedString'],
            'ancestors' => [self::TYPE => '\Sphere\Core\Model\Category\CategoryReferenceCollection'],
            'parent' => [self::TYPE => '\Sphere\Core\Model\Category\CategoryReference'],
            'orderHint' => [self::TYPE => 'string'],
            'externalId' => [self::TYPE => 'string'],
        ];
    }
}
