<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Helper\CurrencyFormatterInterface;
use Psr\Log\LoggerInterface;
use Commercetools\Core\Helper\CurrencyFormatter;

/**
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
class Context implements \ArrayAccess
{
    /**
     * @var bool
     */
    private $graceful = false;

    /**
     * @var array
     */
    private $languages = [];

    /**
     * @var CurrencyFormatterInterface
     */
    private $currencyFormatter;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var LoggerInterface
     */
    private $logger;

    const GRACEFUL = 'graceful';
    const LANGUAGES = 'languages';
    const CURRENCY_FORMATTER = 'currencyFormatter';
    const LOCALE = 'locale';
    const LOGGER = 'logger';

    public function __construct()
    {
        $context = $this;
        $this->currencyFormatter = new CurrencyFormatter($context);
        $this->locale = null;
        if (extension_loaded('intl')) {
            $this->locale = \Locale::getDefault();
        }
        $this->logger = null;
    }

    /**
     * @return boolean
     */
    public function isGraceful()
    {
        return $this->graceful;
    }

    /**
     * @param boolean $graceful
     * @return Context
     */
    public function setGraceful($graceful)
    {
        $this->graceful = $graceful;
        return $this;
    }

    /**
     * @return array
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @param array $languages
     * @return Context
     */
    public function setLanguages(array $languages)
    {
        $this->languages = $languages;
        return $this;
    }

    /**
     * @return CurrencyFormatterInterface
     */
    public function getCurrencyFormatter()
    {
        return $this->currencyFormatter;
    }

    /**
     * @param CurrencyFormatterInterface $currencyFormatter
     * @return Context
     */
    public function setCurrencyFormatter($currencyFormatter)
    {
        $this->currencyFormatter = $currencyFormatter;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     * @return Context
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param LoggerInterface $logger
     * @return Context
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
        return $this;
    }

    public static function of()
    {
        return new static();
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            $method = 'get'.ucfirst($offset);

            return $this->$method();
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        if (property_exists($this, $offset)) {
            $method = 'set'.ucfirst($offset);

            $this->$method($value);
        }
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            $method = 'set'.ucfirst($offset);

            $this->$method(null);
        }
    }
}
