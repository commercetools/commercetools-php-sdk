<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */


namespace Commercetools\Core\Model\Common;

trait LocaleTrait
{
    public function setLocale($locale)
    {
        $locale = \Locale::canonicalize($locale);
        parent::setLocale($locale);

        return $this;
    }

    /**
     * @return array
     */
    public function toJson()
    {
        $data = parent::toJson();
        if (isset($data['locale'])) {
            $data['locale'] = str_replace('_', '-', $data['locale']);
        }

        return $data;
    }
}
