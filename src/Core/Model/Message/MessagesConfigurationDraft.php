<?php
/**
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method bool getEnabled()
 * @method MessagesConfigurationDraft setEnabled(bool $enabled = null)
 * @method int getDeleteDaysAfterCreation()
 * @method MessagesConfigurationDraft setDeleteDaysAfterCreation(int $deleteDaysAfterCreation = null)
 */
class MessagesConfigurationDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'enabled' => [static::TYPE => 'bool'],
            'deleteDaysAfterCreation' => [static::TYPE => 'int'],
        ];
    }

    /**
     * @param bool $enabled
     * @param int $deleteDaysAfterCreation
     * @param Context|callable $context
     * @return MessagesConfigurationDraft
     */
    public static function ofEnabledAndDeleteDaysAfterCreation($enabled, $deleteDaysAfterCreation, $context = null)
    {
        return static::of($context)->setEnabled($enabled)->setDeleteDaysAfterCreation($deleteDaysAfterCreation);
    }
}
