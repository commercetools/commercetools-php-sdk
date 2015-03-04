<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;

/**
 * Class Set
 * @package Sphere\Core\Model\Common
 */
class Set extends Collection
{
    /**
     * @param array $type
     * @param array $data
     * @param Context $context
     */
    public function __construct($type, array $data = [], Context $context = null)
    {
        $this->type = $type;
        $this->setContext($context);
        $this->rawData = $data;
        $this->indexData();
    }

    public static function fromArray(array $data, Context $context = null)
    {
        $type = $data['type'];
        $setData = $data['value'];
        return new static($type, $setData, $context);
    }
}
