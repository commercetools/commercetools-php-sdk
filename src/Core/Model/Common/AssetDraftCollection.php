<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method AssetDraftCollection add(AssetDraft $element)
 * @method AssetDraft current()
 * @method AssetDraft getAt($offset)
 */
class AssetDraftCollection extends Collection
{
    protected $type = AssetDraft::class;
}
