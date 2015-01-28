<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 10:51
 */

namespace Sphere\Core\Model\Draft;


use Sphere\Core\Model\OfTrait;
use Sphere\Core\Model\Type\CategoryReference;
use Sphere\Core\Model\Type\JsonObject;
use Sphere\Core\Model\Type\LocalizedString;

/**
 * Class CategoryDraft
 * @package Sphere\Core\Model\Draft
 * @method static CategoryDraft of(LocalizedString $name, LocalizedString $slug)
 */
class CategoryDraft extends JsonObject
{
    use OfTrait;
    /**
     * @var LocalizedString
     */
    protected $name;

    /**
     * @var LocalizedString
     */
    protected $slug;

    /**
     * @var LocalizedString
     */
    protected $description;

    /**
     * @var CategoryReference
     */
    protected $parent;

    /**
     * @var string
     */
    protected $orderHint;

    /**
     * @var string
     */
    protected $externalId;

    public function __construct(LocalizedString $name, LocalizedString $slug)
    {
        $this->setName($name);
        $this->setSlug($slug);
    }


    /**
     * @return LocalizedString
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param LocalizedString $name
     * @return $this
     */
    public function setName(LocalizedString $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return LocalizedString
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param LocalizedString $slug
     * @return $this
     */
    public function setSlug(LocalizedString $slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return LocalizedString
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param LocalizedString $description
     * @return $this
     */
    public function setDescription(LocalizedString $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return CategoryReference
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param CategoryReference $parent
     * @return $this
     */
    public function setParent(CategoryReference $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderHint()
    {
        return $this->orderHint;
    }

    /**
     * @param string $orderHint
     * @return $this
     */
    public function setOrderHint($orderHint)
    {
        $this->orderHint = $orderHint;

        return $this;
    }

    /**
     * @return string
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * @param string $externalId
     * @return $this
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;

        return $this;
    }

    /**
     * @param LocalizedString $test
     * @return LocalizedString
     */
    public static function test(LocalizedString $test)
    {

    }
}
