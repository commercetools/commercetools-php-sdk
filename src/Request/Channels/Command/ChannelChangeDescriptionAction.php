<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Channels\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ChannelChangeDescriptionAction
 * @package Sphere\Core\Request\Channels\Command
 *  *
 * @method string getAction()
 * @method ChannelChangeDescriptionAction setAction(string $action = null)
 * @method LocalizedString getDescription()
 * @method ChannelChangeDescriptionAction setDescription(LocalizedString $description = null)
 */
class ChannelChangeDescriptionAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'description' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
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
