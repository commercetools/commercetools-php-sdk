<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomField;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\CustomField
 * @link https://docs.commercetools.com/http-api-projects-custom-fields.html#customfieldsdraft
 * @method CustomFieldObjectDraftCollection add(CustomFieldObjectDraft $element)
 * @method CustomFieldObjectDraft current()
 * @method CustomFieldObjectDraft getAt($offset)
 */
class CustomFieldObjectDraftCollection extends Collection
{
    protected $type = CustomFieldObjectDraft::class;
}
