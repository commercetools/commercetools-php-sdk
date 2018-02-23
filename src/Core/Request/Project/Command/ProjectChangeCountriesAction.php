<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Project\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Project\Command
 * @link https://docs.commercetools.com/http-api-projects-project.html#change-countries
 * @method string getAction()
 * @method ProjectChangeCountriesAction setAction(string $action = null)
 * @method array getCountries()
 * @method ProjectChangeCountriesAction setCountries(array $countries = null)
 */
class ProjectChangeCountriesAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'countries' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeCountries');
    }

    /**
     * @param array $countries
     * @param Context|callable $context
     * @return ProjectChangeCountriesAction
     */
    public static function ofCountries($countries, $context = null)
    {
        return static::of($context)->setCountries($countries);
    }
}
