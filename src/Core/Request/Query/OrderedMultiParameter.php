<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Query;

class OrderedMultiParameter extends Parameter
{
    private $position;

    public function __construct($key, $value = null, $position = 0)
    {
        $this->position = $position;
        parent::__construct($key, $value);
    }

    public function getId()
    {
        return sprintf("%s-%010d", $this->key, $this->position);
    }
}
