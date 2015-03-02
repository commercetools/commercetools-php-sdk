<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


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
     * @return array
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @param array $languages
     */
    public function setLanguages(array $languages)
    {
        $this->languages = $languages;
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
     */
    public function setGraceful($graceful)
    {
        $this->graceful = $graceful;
    }
}
