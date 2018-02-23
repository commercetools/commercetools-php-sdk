<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Zones\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Zones\Command
 * @link https://docs.commercetools.com/http-api-projects-zones.html#set-description
 * @method string getAction()
 * @method ZoneSetDescriptionAction setAction(string $action = null)
 * @method string getDescription()
 * @method ZoneSetDescriptionAction setDescription(string $description = null)
 */
class ZoneSetDescriptionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setDescription');
    }
}
