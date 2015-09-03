<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Category;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Category
 * @method Category current()
 * @method CategoryCollection add(Category $element)
 * @method Category getAt($offset)
 */
class CategoryCollection extends Collection
{
    const SLUG = 'slug';

    protected $type = '\Commercetools\Core\Model\Category\Category';

    protected function indexRow($offset, $row)
    {
        if ($row instanceof Category) {
            $slugs = $row->getSlug()->toArray();
        } else {
            $slugs = isset($row[static::SLUG]) ? $row[static::SLUG] : [];
        }
        foreach ($slugs as $locale => $slug) {
            $locale = \Locale::canonicalize($locale);
            $this->addToIndex(static::SLUG, $offset, $locale . '-' . $slug);
        }
    }

    /**
     * @param $locale
     * @param $slug
     * @return Category
     */
    public function getBySlug($slug, $locale)
    {
        $locale = \Locale::canonicalize($locale);
        $category = $this->getBy(static::SLUG, $locale . '-' . $slug);

        if ($category instanceof Category) {
            return $category;
        }

        $language = \Locale::getPrimaryLanguage($locale);
        return $this->getBy(static::SLUG, $language . '-' . $slug);
    }
}
