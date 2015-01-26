<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 21.01.15, 11:38
 */

namespace Sphere\Core\Http;


interface ClientRequest
{
    /**
     * @return HttpRequestInterface
     */
    public function httpRequest();
}
