<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Reviews\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Reviews\Command
 * @link https://dev.commercetools.com/http-api-projects-reviews.html#set-locale
 * @method string getAction()
 * @method ReviewSetLocaleAction setAction(string $action = null)
 * @method string getLocale()
 * @method ReviewSetLocaleAction setLocale(string $locale = null)
 */
class ReviewSetLocaleAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'locale' => [static::TYPE => 'string'],
        ];
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

    public function jsonSerialize()
    {
        $data = parent::jsonSerialize();
        if (isset($data['locale'])) {
            $data['locale'] = str_replace('_', '-', $data['locale']);
        }
        return $data;
    }
}
