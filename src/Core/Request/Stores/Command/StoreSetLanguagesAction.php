<?php

namespace Commercetools\Core\Request\Stores\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Stores\Command
 * @link https://docs.commercetools.com/http-api-projects-stores#set-languages
 * @method string getAction()
 * @method StoreSetLanguagesAction setAction(string $action = null)
 * @method array getLanguages()
 * @method StoreSetLanguagesAction setLanguages(array $languages = null)
 */
class StoreSetLanguagesAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'languages' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setLanguages');
    }

    /**
     * @param array $languages
     * @param Context|callable $context
     * @return StoreSetLanguagesAction
     */
    public static function ofLanguages(array $languages, $context = null)
    {
        return static::of($context)->setLanguages($languages);
    }
}
