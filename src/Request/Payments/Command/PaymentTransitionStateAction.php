<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Payments\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\State\StateReference;

/**
 * @package Commercetools\Core\Request\Payments\Commands
 *
 * @method string getAction()
 * @method PaymentTransitionStateAction setAction(string $action = null)
 * @method StateReference getState()
 * @method PaymentTransitionStateAction setState(StateReference $state = null)
 */
class PaymentTransitionStateAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'state' => [static::TYPE => '\Commercetools\Core\Model\State\StateReference'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('transitionState');
    }
}
