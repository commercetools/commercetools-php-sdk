<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Product;


use Sphere\Core\Error\InvalidArgumentException;
use Sphere\Core\Error\Message;
use Sphere\Core\Model\Common\Collection;
use Sphere\Core\Model\Common\Context;

/**
 * Class LocalizedSearchKeywords
 * @package Sphere\Core\Model\Product
 * @link http://dev.sphere.io/http-api-projects-products.html#search-keywords
 */
class LocalizedSearchKeywords extends Collection
{
    protected $type = '\Sphere\Core\Model\Product\SearchKeywords';

    /**
     * @param $locale
     * @return SearchKeywords
     */
    public function __get($locale)
    {
        $context = new Context();
        $context->setGraceful($this->getContext()->isGraceful())
            ->setLanguages([$locale]);
        return $this->get($context);
    }

    /**
     * @param Context $context
     * @return string
     */
    protected function getLanguage(Context $context)
    {
        $locale = null;
        foreach ($context->getLanguages() as $language) {
            if (isset($this[$language])) {
                $locale = $language;
                break;
            }
        }
        return $locale;
    }

    /**
     * @param Context $context
     * @return string
     */
    public function get(Context $context = null)
    {
        if (is_null($context)) {
            $context = $this->getContext();
        }
        $locale = $this->getLanguage($context);
        if (!isset($this[$locale])) {
            if (!$context->isGraceful()) {
                throw new InvalidArgumentException(Message::NO_VALUE_FOR_LOCALE);
            }
            return '';
        }
        return $this->getAt($locale);
    }

    /**
     * @param $object
     * @return $this
     * @internal
     */
    public function add($object)
    {
        return parent::add($object);
    }

    public function __toString()
    {
        return (string)$this->get();
    }
}
