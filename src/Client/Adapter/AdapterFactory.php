<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Client\Adapter;


class AdapterFactory
{
    public function getClass($name)
    {
        switch ($name) {
            case "guzzle5":
                return '\Sphere\Core\Client\Adapter\Guzzle5Adapter';
            case "guzzle6":
            default:
                return '\Sphere\Core\Client\Adapter\Guzzle6Adapter';

        }
    }
}
