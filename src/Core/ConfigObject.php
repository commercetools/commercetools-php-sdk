<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Error\Message;

abstract class ConfigObject
{
    /**
     * @param array $configValues
     * @return static
     */
    public static function fromArray(array $configValues)
    {
        $config = static::of();
        array_walk(
            $configValues,
            function ($value, $key) use ($config) {
                $functionName = 'set' . $config->camelize($key);
                if (!is_callable([$config, $functionName])) {
                    throw new InvalidArgumentException(sprintf(Message::SETTER_NOT_IMPLEMENTED, $key));
                }
                $config->$functionName($value);
            }
        );

        return $config;
    }

    protected function camelize($scored)
    {
        return lcfirst(
            implode(
                '',
                array_map(
                    'ucfirst',
                    array_map(
                        'strtolower',
                        explode('_', $scored)
                    )
                )
            )
        );
    }

    /**
     * @return static
     */
    public static function of()
    {
        return new static();
    }
}
