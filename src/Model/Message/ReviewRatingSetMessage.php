<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

class ReviewRatingSetMessage extends Message
{
    const MESSAGE_TYPE = 'ReviewRatingSet';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['oldRating'] = [static::TYPE => 'float'];
        $definitions['newRating'] = [static::TYPE => 'float'];
        $definitions['includedInStatistics'] = [static::TYPE => 'bool'];
        $definitions['target'] = [static::TYPE => '\Commercetools\Core\Model\Common\Reference'];

        return $definitions;
    }
}
