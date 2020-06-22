<?php

namespace Commercetools\Core\Request\Project\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Project\Command
 * @link  https://docs.commercetools.com/http-api-projects-project.html#change-country-tax-rate-fallback-enabled
 * @method string getAction()
 * @method ProjectChangeCountryTaxRateFallbackEnabledAction setAction(string $action = null)
 * @method bool getCountryTaxRateFallbackEnabled()
 * phpcs:disable
 * @method ProjectChangeCountryTaxRateFallbackEnabledAction setCountryTaxRateFallbackEnabled(bool $countryTaxRateFallbackEnabled = null)
 * phpcs:enable
 */
class ProjectChangeCountryTaxRateFallbackEnabledAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'countryTaxRateFallbackEnabled' => [static::TYPE => 'bool'],
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
     * @param boolean $countryTaxRateFallbackEnabled
     * @param Context|callable $context
     * @return ProjectChangeCountryTaxRateFallbackEnabledAction
     */
    public static function ofCountryTaxRateFallbackEnabled($countryTaxRateFallbackEnabled, $context = null)
    {
        return static::of($context)->setCountryTaxRateFallbackEnabled($countryTaxRateFallbackEnabled);
    }
}
