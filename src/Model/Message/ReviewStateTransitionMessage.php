<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

class ReviewStateTransitionMessage extends Message
{
    const MESSAGE_TYPE = 'ReviewStateTransition';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['oldState'] = [static::TYPE => '\Commercetools\Core\Model\State\StateReference'];
        $definitions['newState'] = [static::TYPE => '\Commercetools\Core\Model\State\StateReference'];
        $definitions['oldIncludedInStatistics'] = [static::TYPE => 'bool'];
        $definitions['newIncludedInStatistics'] = [static::TYPE => 'bool'];
        $definitions['target'] = [static::TYPE => '\Commercetools\Core\Model\Common\Reference'];
        $definitions['force'] = [static::TYPE => 'bool'];

        return $definitions;
    }
}
