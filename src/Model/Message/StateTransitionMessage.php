<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;


abstract class StateTransitionMessage extends Message
{
    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['state'] = [static::TYPE => '\Commercetools\Core\Model\State\StateReference'];

        return $definitions;
    }
}
