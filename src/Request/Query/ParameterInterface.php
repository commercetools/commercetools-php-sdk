<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Query;

interface ParameterInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function __toString();
}
