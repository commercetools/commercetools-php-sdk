<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 27.01.15, 14:53
 */

namespace Sphere\Core\Model\Type;

use Sphere\Core\Model\OfTrait;

/**
 * Class Reference
 * @package Sphere\Core\Model\Type
 * @method static Reference of(string $typeId, string $id)
 */
class Reference extends JsonObject
{
    /**
     * @var string
     */
    protected $typeId;

    /**
     * @var string
     */
    protected $id;

    /**
     * @param string $typeId
     * @param string $id
     */
    public function __construct($typeId, $id)
    {
        $this->setTypeId($typeId);
        $this->setId($id);
    }

    /**
     * @return string
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * @param string $typeId
     * @return $this
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
