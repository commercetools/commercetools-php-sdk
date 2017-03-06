<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\State;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\State
 * @link https://dev.commercetools.com/http-api-projects-states.html#statedraft
 * @method string getKey()
 * @method StateDraft setKey(string $key = null)
 * @method string getType()
 * @method StateDraft setType(string $type = null)
 * @method LocalizedString getName()
 * @method StateDraft setName(LocalizedString $name = null)
 * @method LocalizedString getDescription()
 * @method StateDraft setDescription(LocalizedString $description = null)
 * @method bool getInitial()
 * @method StateDraft setInitial(bool $initial = null)
 * @method StateReferenceCollection getTransitions()
 * @method StateDraft setTransitions(StateReferenceCollection $transitions = null)
 * @method array getRoles()
 * @method StateDraft setRoles(array $roles = null)
 */
class StateDraft extends JsonObject
{
    const TYPE_LINE_ITEM_STATE = 'LineItemState';

    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'type' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
            'description' => [static::TYPE => LocalizedString::class],
            'initial' => [static::TYPE => 'bool'],
            'transitions' => [static::TYPE => StateReferenceCollection::class],
            'roles' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param $key
     * @param Context|callable $context
     * @return StateDraft
     */
    public static function ofKey($key, $context = null)
    {
        return static::ofKeyAndType($key, self::TYPE_LINE_ITEM_STATE, $context);
    }

    /**
     * @param string $key
     * @param string $type
     * @param Context|callable $context
     * @return StateDraft
     */
    public static function ofKeyAndType($key, $type, $context = null)
    {
        return static::of($context)->setKey($key)->setType($type);
    }
}
