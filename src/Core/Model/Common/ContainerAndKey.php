<?php


namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method string getContainer()
 * @method ContainerAndKey setContainer(string $container = null)
 * @method string getKey()
 * @method ContainerAndKey setKey(string $key = null)
 */
class ContainerAndKey extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'container' => [self::TYPE => 'string'],
            'key' => [self::TYPE => 'string'],
        ];
    }
}
