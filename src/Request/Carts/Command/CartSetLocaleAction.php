<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Carts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Carts\Command
 *
 * @method string getAction()
 * @method CartSetLocaleAction setAction(string $action = null)
 * @method string getLocale()
 */
class CartSetLocaleAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'locale' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param string $locale
     * @param Context|callable $context
     * @return CartSetLocaleAction
     */
    public static function ofLocale($locale, $context = null)
    {
        return static::of($context)->setLocale($locale);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setLocale');
    }

    public function setLocale($locale)
    {
        $locale = \Locale::canonicalize($locale);
        parent::setLocale($locale);

        return $this;
    }

    /**
     * @return array
     */
    public function toJson()
    {
        $data = parent::toArray();
        $data['locale'] = str_replace('_', '-', $data['locale']);

        return $data;
    }
}
