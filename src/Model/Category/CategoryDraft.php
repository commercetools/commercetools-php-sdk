<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 10:51
 */

namespace Sphere\Core\Model\Category;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Model\Common\OfTrait;

/**
 * Class CategoryDraft
 * @package Sphere\Core\Model\Category
 * @method static CategoryDraft of(LocalizedString $name, LocalizedString $slug)
 * @method LocalizedString getName()
 * @method LocalizedString getSlug()
 * @method LocalizedString getDescription()
 * @method CategoryReference getParent()
 * @method string getOrderHint()
 * @method string getExternalId()
 * @method CategoryDraft setName(LocalizedString $name)
 * @method CategoryDraft setSlug(LocalizedString $slug)
 * @method CategoryDraft setDescription(LocalizedString $description)
 * @method CategoryDraft setParent(CategoryReference $parent)
 * @method CategoryDraft setOrderHint(string $orderHint)
 * @method CategoryDraft setExternalId(string $externalId)
 */
class CategoryDraft extends JsonObject
{
    use OfTrait;

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
     * @param Context $context
     */
    public function __construct(LocalizedString $name, LocalizedString $slug, Context $context = null)
    {
        $this->setContext($context);
        $this->setName($name);
        $this->setSlug($slug);
    }

    /**
     * @param array $data
     * @param Context $context
     * @return static
     */
    public static function fromArray(array $data, Context $context = null)
    {
        $draft = new static(
            LocalizedString::fromArray($data['name'], $context),
            LocalizedString::fromArray($data['slug'], $context),
            $context
        );
        $draft->setRawData($data);

        return $draft;
    }
}
