<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://dev.commercetools.com/http-api-projects-products.html#publish
 * @method string getAction()
 * @method ProductPublishAction setAction(string $action = null)
 * @method string getScope()
 * @method ProductPublishAction setScope(string $scope = null)
 */
class ProductPublishAction extends AbstractAction
{
    const ALL = 'All';
    const PRICES = 'Prices';

    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'scope' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('publish');
    }
}
