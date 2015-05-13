<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\CustomerGroup;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\OfTrait;

/**
 * Class CustomerGroupDraft
 * @package Sphere\Core\Model\CustomerGroup
 * @method string getGroupName()
 * @method CustomerGroupDraft setGroupName(string $groupName = null)
 */
class CustomerGroupDraft extends JsonObject
{
    use OfTrait;

    public function getFields()
    {
        return [
            'groupName' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param string $groupName
     * @param Context|callable $context
     */
    public function __construct($groupName, $context = null)
    {
        $this->setContext($context)->setGroupName($groupName);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        $draft = new static(
            $data['groupName'],
            $context
        );
        $draft->setRawData($data);

        return $draft;
    }
}
