<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method bool getEnabled()
 * @method MessagesConfiguration setEnabled(bool $enabled = null)
 * @method int getDeleteDaysAfterCreation()
 * @method MessagesConfiguration setDeleteDaysAfterCreation(int $deleteDaysAfterCreation = null)
 */
class MessagesConfiguration extends MessagesConfigurationDraft
{
    public function fieldDefinitions()
    {
        return [
            'enabled' => [static::TYPE => 'bool'],
            'deleteDaysAfterCreation' => [static::TYPE => 'int', static::OPTIONAL => true],
        ];
    }
}
