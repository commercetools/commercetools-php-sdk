<?php

namespace Commercetools\Core\Request\Project\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Project\Command
 * @link  https://docs.commercetools.com/http-api-projects-project.html#change-country-tax-rate-fallback-enabled
 * @method string getAction()
 * @method ProjectChangeCountryTaxRateFallbackEnabledAction setAction(string $action = null)
 * @method boolean getCountryTaxRateFallbackEnabled()
 * phpcs:disable
 * @method ProjectChangeCountryTaxRateFallbackEnabledAction setCountryTaxRateFallbackEnabled(boolean $countryTaxRateFallbackEnabled = null)
 * phpcs:enable
 */
class ProjectChangeCountryTaxRateFallbackEnabledAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'countryTaxRateFallbackEnabled' => [static::TYPE => 'boolean'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeCountryTaxRateFallbackEnabled');
    }

    /**
     * @param boolean $countryTaxRateFallback
     * @param Context|callable $context
     * @return ProjectChangeCountryTaxRateFallbackEnabledAction
     */
    public static function ofCountryTaxRateFallback($countryTaxRateFallback, $context = null)
    {
        return static::of($context)->setCountryTaxRateFallbackEnabled($countryTaxRateFallback);
    }
}
