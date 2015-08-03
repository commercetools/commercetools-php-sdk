<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;


use Pimple\Container;
use Psr\Log\LoggerInterface;
use Commercetools\Core\Helper\CurrencyFormatter;

/**
 * The context is a container class. Giving the possibility to inject information or behaviour to the models
 *
 * @description
 * ## Usage
 *
 * The context will be set at ContextAware objects like JsonObject and Collection. By adding a context to the client
 * config the context will be set to all request, responses and other ContextAware objects. Besides that you can always
 * set a new context to every ContextAware object at any time.
 *
 * ```php
 * $context = Context::of();
 * ```
 *
 * For production environments it's advised to set the graceful flag to prevent Exceptions by toString conversions()
 *
 * ```php
 * $context->setGraceful(true);
 * ```

 * ### Languages and Locales
 *
 * For automatic fallback string conversion e.g. with LocalizedString you can set the available languages. The
 * LocalizedString will try to resolve a string in the given order. It's strongly advised to set the locale in
 * the Context as it is used for example by the CurrencyFormatter. If no locale is set, the default locale given
 * by php config will be used.
 *
 * ```php
 * $context->setLanguages(['de', 'en'])->setLocale('de_DE');
 * ```
 *
 * ### CurrencyFormatter
 *
 * The context provides a builtin CurrencyFormatter. The default currency formatter will format a currency with
 * the help of the intl extension and the locale set.
 *
 * Example for custom currency formatter:
 * ```php
 * $currencyFormatter = new CurrencyFormatter();
 * $currencyFormatter->setFormatCallback(function($centAmount, $currency)) {
 *     $amount = $centAmount / 100;
 *     $currency = mb_strtoupper($currency);
 *     $locale = $this->context->getLocale();
 *
 *     $formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
 *     return $formatter->formatCurrency($amount, $currency);
 * }
 * $context->setCurrencyFormatter($currencyFormatter);
 * ```
 *
 * @package Commercetools\Core\Model\Common
 */
class Context extends Container
{
    const GRACEFUL = 'graceful';
    const LANGUAGES = 'languages';
    const CURRENCY_FORMATTER = 'currencyFormatter';
    const LOCALE = 'locale';
    const LOGGER = 'logger';

    public function __construct()
    {
        parent::__construct();

        $context = $this;
        $this[static::GRACEFUL] = false;
        $this[static::LANGUAGES] = [];
        $this[static::CURRENCY_FORMATTER] = function () use ($context) {
            return new CurrencyFormatter($context);
        };
        $this[static::LOCALE] = null;
        if (extension_loaded('intl')) {
            $this[static::LOCALE] = \Locale::getDefault();
        }
        $this[static::LOGGER] = null;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this[static::LOCALE];
    }

    /**
     * @param $locale
     * @return $this
     */
    public function setLocale($locale)
    {
        $this[static::LOCALE] = $locale;

        return $this;
    }

    /**
     * @return CurrencyFormatter
     */
    public function getCurrencyFormatter()
    {
        return $this[static::CURRENCY_FORMATTER];
    }

    /**
     * @param CurrencyFormatter $currencyFormatter
     * @return $this
     */
    public function setCurrencyFormatter(CurrencyFormatter $currencyFormatter)
    {
        $this[static::CURRENCY_FORMATTER] = $currencyFormatter;

        return $this;
    }

    /**
     * @return array
     */
    public function getLanguages()
    {
        return $this[static::LANGUAGES];
    }

    /**
     * @param array $languages
     * @return $this
     */
    public function setLanguages(array $languages)
    {
        $this[static::LANGUAGES] = $languages;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isGraceful()
    {
        return $this[static::GRACEFUL];
    }

    /**
     * @param $graceful
     * @return $this
     */
    public function setGraceful($graceful)
    {
        $this[static::GRACEFUL] = $graceful;

        return $this;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this[static::LOGGER];
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this[static::LOGGER] = $logger;

        return $this;
    }

    public static function of()
    {
        return new static();
    }
}
