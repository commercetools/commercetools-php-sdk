<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Channels\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Channels\Command
 * @link https://docs.commercetools.com/http-api-projects-channels.html#change-description
 * @method string getAction()
 * @method ChannelChangeDescriptionAction setAction(string $action = null)
 * @method LocalizedString getDescription()
 * @method ChannelChangeDescriptionAction setDescription(LocalizedString $description = null)
 */
class ChannelChangeDescriptionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'description' => [static::TYPE => LocalizedString::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeDescription');
    }

    /**
     * @param LocalizedString $description
     * @param Context|callable $context
     * @return ChannelChangeDescriptionAction
     */
    public static function ofDescription(LocalizedString $description, $context = null)
    {
        return static::of($context)->setDescription($description);
    }
}
