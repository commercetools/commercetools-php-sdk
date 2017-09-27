<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\State\StateReference;

abstract class StateTransitionMessage extends Message
{
    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['state'] = [static::TYPE => StateReference::class];
        $definitions['force'] = [static::TYPE => 'bool'];

        return $definitions;
    }
}
