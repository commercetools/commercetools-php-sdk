<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Client\Adapter;

use GuzzleHttp\Client;
use Commercetools\Core\Error\InvalidArgumentException;

class AdapterFactory
{
    protected $adapters = [];

    public function __construct()
    {
        $this->register('guzzle5', '\Commercetools\Core\Client\Adapter\Guzzle5Adapter')
            ->register('guzzle6', '\Commercetools\Core\Client\Adapter\Guzzle6Adapter');
    }

    /**
     * @param string $name
     * @param string $adapterClass
     * @return $this
     */
    public function register($name, $adapterClass)
    {
        $this->adapters[$name] = $adapterClass;

        return $this;
    }

    /**
     * @param string $name
     * @return string
     */
    public function getClass($name = null)
    {
        if (is_null($name)) {
            if (version_compare(Client::VERSION, '6.0.0', '>=')) {
                $name = 'guzzle6';
            } else {
                $name = 'guzzle5';
            }
        }
        if (isset($this->adapters[$name])) {
            return $this->adapters[$name];
        }

        throw new InvalidArgumentException();
    }
}
