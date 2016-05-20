<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

class ReviewCreatedMessage extends Message
{
    const MESSAGE_TYPE = 'ReviewCreated';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['review'] = [static::TYPE => '\Commercetools\Core\Model\Review\Review'];

        return $definitions;
    }
}
