<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 10:51
 */

namespace Sphere\Core\Model\Category;


use Herrera\Phar\Update\Exception\InvalidArgumentException;
use Sphere\Core\Model\GeneralInfoTrait;
use Sphere\Core\Model\OfTrait;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\LocalizedString;

/**
 * Class CategoryDraft
 * @package Sphere\Core\Model\Draft
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

    protected $data = [];

    public function getFields()
    {
        return [
            'name' => [self::TYPE => 'Sphere\Core\Model\Type\LocalizedString'],
            'slug' => [self::TYPE => 'Sphere\Core\Model\Type\LocalizedString'],
            'description' => [self::TYPE => 'Sphere\Core\Model\Type\LocalizedString'],
            'parent' => [self::TYPE => '\Sphere\Core\Model\Category\CategoryReference'],
            'orderHint' => [self::TYPE => 'string'],
            'externalId' => [self::TYPE => 'string'],
        ];
    }

    public function __construct(LocalizedString $name, LocalizedString $slug)
    {
        $this->setName($name);
        $this->setSlug($slug);
    }
}
