<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


use Sphere\Core\Helper\CurrencyFormatter;

class Context
{
    /**
     * @var bool
     */
    protected $graceful = false;

    /**
     * @var array
     */
    protected $languages = [];

    /**
     * @var CurrencyFormatter
     */
    protected $currencyFormatter;

    /**
     * @var
     */
    protected $locale;

    /**
     * @return string
     */
    public function getLocale()
    {
        if (is_null($this->locale) && extension_loaded('intl')) {
            $this->locale = \Locale::getDefault();
        }
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return CurrencyFormatter
     */
    public function getCurrencyFormatter()
    {
        if (is_null($this->currencyFormatter)) {
            $this->currencyFormatter = new CurrencyFormatter($this);
        }
        return $this->currencyFormatter;
    }

    /**
     * @param CurrencyFormatter $currencyFormatter
     */
    public function setCurrencyFormatter(CurrencyFormatter $currencyFormatter)
    {
        $this->currencyFormatter = $currencyFormatter;
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
     * @return $this
     */
    public function setLanguages(array $languages)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isGraceful()
    {
        return $this->graceful;
    }

    /**
     * @param $graceful
     * @return $this
     */
    public function setGraceful($graceful)
    {
        $this->graceful = $graceful;

        return $this;
    }
}
