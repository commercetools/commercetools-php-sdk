<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://dev.commercetools.com/http-api-projects-types.html#field-definition
 * @method FieldDefinition current()
 * @method FieldDefinitionCollection add(FieldDefinition $element)
 * @method FieldDefinition getAt($offset)
 */
class FieldDefinitionCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Type\FieldDefinition';

    const NAME = 'name';

    protected function indexRow($offset, $row)
    {
        if ($row instanceof FieldDefinition) {
            $name = $row->getName();
        } else {
            $name = $row[static::NAME];
        }
        $this->addToIndex(static::NAME, $offset, $name);
    }

    /**
     * @param $name
     * @return FieldDefinition
     */
    public function getByName($name)
    {
        return $this->getBy(static::NAME, $name);
    }
}
