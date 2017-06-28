<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Category;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Category
 * @link https://dev.commercetools.com/http-api-projects-categories.html#category
 * @method Category current()
 * @method CategoryCollection add(Category $element)
 * @method Category getAt($offset)
 */
class CategoryCollection extends Collection
{
    const SLUG = 'slug';
    const PARENT = 'parent';
    const ROOTS = 'roots';
    const KEY = 'key';

    protected $type = Category::class;

    protected function indexRow($offset, $row)
    {
        if ($row instanceof Category) {
            $slugs = $row->getSlug()->toArray();
            $parentId = !is_null($row->getParent()) ? $row->getParent()->getId() : null;
            $id = $row->getId();
            $key = $row->getKey();
        } else {
            $slugs = isset($row[static::SLUG]) ? $row[static::SLUG] : [];
            $id = isset($row[static::ID]) ? $row[static::ID] : null;
            $key = isset($row[static::KEY]) ? $row[static::KEY] : null;
            $parentId = isset($row[static::PARENT][static::ID]) ? $row[static::PARENT][static::ID] : null;
        }
        $this->addToIndex(static::ID, $offset, $id);
        $this->addToIndex(static::KEY, $offset, $key);
        foreach ($slugs as $locale => $slug) {
            $locale = \Locale::canonicalize($locale);
            $this->addToIndex(static::SLUG, $offset, $locale . '-' . $slug);
            if (is_null($parentId)) {
                $this->addToIndex(static::ROOTS, $offset, $id);
            } else {
                $this->addToIndex(static::PARENT . '-' . $parentId, $offset, $id);
            }
        }
    }

    /**
     * @param $id
     * @return Category|null
     */
    public function getById($id)
    {
        return $this->getBy(static::ID, $id);
    }

    /**
     * @param $key
     * @return Category|null
     */
    public function getByKey($key)
    {
        return $this->getBy(static::KEY, $key);
    }

    /**
     * @return Category[]
     */
    public function getRoots()
    {
        $elements = [];
        foreach ($this->index[static::ROOTS] as $key => $offset) {
            $elements[$key] = $this->getAt($offset);
        }
        return $elements;
    }

    /**
     * @param $parentId
     * @return Category[]
     */
    public function getByParent($parentId)
    {
        $elements = [];
        if (!isset($this->index[static::PARENT . '-' . $parentId])) {
            return $elements;
        }

        foreach ($this->index[static::PARENT . '-' . $parentId] as $key => $offset) {
            $elements[$key] = $this->getAt($offset);
        }
        return $elements;
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
