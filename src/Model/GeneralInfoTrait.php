<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 05.02.15, 11:26
 */

namespace Sphere\Core\Model;


use Sphere\Core\Model\Type\LocalizedString;

trait GeneralInfoTrait
{
    /**
     * @var LocalizedString
     */
    protected $name;

    /**
     * @var LocalizedString
     */
    protected $slug;

    /**
     * @var LocalizedString
     */
    protected $description;

    /**
     * @return LocalizedString
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param LocalizedString $name
     * @return $this
     */
    public function setName(LocalizedString $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return LocalizedString
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param LocalizedString $slug
     * @return $this
     */
    public function setSlug(LocalizedString $slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return LocalizedString
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param LocalizedString $description
     * @return $this
     */
    public function setDescription(LocalizedString $description)
    {
        $this->description = $description;

        return $this;
    }
}
