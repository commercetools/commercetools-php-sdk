<?php
/**
 */

namespace Commercetools\Core\Request\Extensions\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Extension\Destination;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Extensions\Command
 * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#change-destination
 * @method string getAction()
 * @method ExtensionChangeDestinationAction setAction(string $action = null)
 * @method Destination getDestination()
 * @method ExtensionChangeDestinationAction setDestination(Destination $destination = null)
 */
class ExtensionChangeDestinationAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'destination' => [static::TYPE => Destination::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeDestination');
    }
}
