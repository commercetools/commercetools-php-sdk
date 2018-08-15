<?php
/**
 */

namespace Commercetools\Core\Model\Extension;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Extension
 * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#extensiondraft
 * @method string getKey()
 * @method ExtensionDraft setKey(string $key = null)
 * @method Destination getDestination()
 * @method ExtensionDraft setDestination(Destination $destination = null)
 * @method TriggerCollection getTriggers()
 * @method ExtensionDraft setTriggers(TriggerCollection $triggers = null)
 */
class ExtensionDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'destination' => [static::TYPE => Destination::class],
            'triggers' => [static::TYPE => TriggerCollection::class],
        ];
    }

    /**
     * @param Destination $destination
     * @param TriggerCollection $triggers
     * @param Context|callable $context
     * @return ExtensionDraft
     */
    public static function ofDestinationAndTriggers(
        Destination $destination,
        TriggerCollection $triggers,
        $context = null
    ) {
        return static::of($context)->setDestination($destination)->setTriggers($triggers);
    }
}
