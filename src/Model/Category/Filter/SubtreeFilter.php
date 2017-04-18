<?php
/**
 * @author @Haehnchen <daniel@ependiller.net>
 */

namespace Commercetools\Core\Model\Category\Filter;

use Commercetools\Core\Model\Product\Search\FilterInterface;

/**
 * @package Commercetools\Core\Model\Category\Filter
 */
class SubtreeFilter implements FilterInterface
{
    /**
     * @var array
     */
    private $uuids;

    /**
     * SubtreeFilter constructor.
     *
     * @param string $uuids category uuid
     */
    public function __construct(array $uuids)
    {
        $this->uuids = $uuids;
    }

    /**
     * Create instance from single uuid id
     *
     * @param $uuid
     * @return static
     */
    public static function createFromUuid($uuid)
    {
        return new static([$uuid]);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return 'categories.id:' . implode(',', array_map(function ($uuid) {
            return 'subtree("' . $uuid . '")';
        }, $this->uuids));
    }
}
