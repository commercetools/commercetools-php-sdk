<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 05.02.15, 11:28
 */

namespace Sphere\Core\Model;


use Sphere\Core\Model\Type\LocalizedString;

trait MetaInfoTrait
{
    /**
     * @var LocalizedString
     */
    protected $metaTitle;

    /**
     * @var LocalizedString
     */
    protected $metaDescription;

    /**
     * @var LocalizedString
     */
    protected $metaKeywords;

    /**
     * @return LocalizedString
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @param LocalizedString $metaTitle
     * @return $this
     */
    public function setMetaTitle(LocalizedString $metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * @return LocalizedString
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param LocalizedString $metaDescription
     * @return $this
     */
    public function setMetaDescription(LocalizedString $metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * @return LocalizedString
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * @param LocalizedString $metaKeywords
     * @return $this
     */
    public function setMetaKeywords(LocalizedString $metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }
}
