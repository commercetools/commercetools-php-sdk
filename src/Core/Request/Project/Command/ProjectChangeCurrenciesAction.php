<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Project\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Project\Command
 * @link https://docs.commercetools.com/http-api-projects-project.html#change-currencies
 * @method string getAction()
 * @method ProjectChangeCurrenciesAction setAction(string $action = null)
 * @method array getCurrencies()
 * @method ProjectChangeCurrenciesAction setCurrencies(array $currencies = null)
 */
class ProjectChangeCurrenciesAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'currencies' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeCurrencies');
    }

    /**
     * @param array $currencies
     * @param Context|callable $context
     * @return ProjectChangeCurrenciesAction
     */
    public static function ofCurrencies($currencies, $context = null)
    {
        return static::of($context)->setCurrencies($currencies);
    }
}
