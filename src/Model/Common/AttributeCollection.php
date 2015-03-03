<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;

/**
 * Class AttributeCollection
 * @package Sphere\Core\Model\Common
 */
class AttributeCollection extends Collection
{
    const NAME = 'name';

    protected $type = '\Sphere\Core\Model\Common\Attribute';

    protected function indexRow($offset, $row)
    {
        if ($row instanceof Attribute) {
            $name = $row->getName();
        } else {
            $name = $row[static::NAME];
        }
        $this->addToIndex(static::NAME, $offset, $name);
    }

    public function __get($attributeName)
    {
        return $this->getByName($attributeName);
    }

    public function getByName($attributeName)
    {
        return $this->getBy(static::NAME, $attributeName);
    }
}
