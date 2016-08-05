<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Customers\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Customers\Command
 *
 * @method string getAction()
 * @method CustomerSetLocaleAction setAction(string $action = null)
 * @method string getLocale()
 */
class CustomerSetLocaleAction extends AbstractAction
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
     * @return CustomerSetLocaleAction
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
