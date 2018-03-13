<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

/**
 * Exception for responses with status code 400
 * @package Commercetools\Core\Error
 * @description
 * ## ErrorCodes
 * ### InvalidField
 * One possible cause could be, that you try to set the value of a product attribute and the type is not matching or
 * you have an enum field and the key is wrong.
 *
 * Example:
 *
 * ```json
 * {
 *   "statusCode": 400,
 *   "message": "The value '2' is not valid for field 'fieldNameExample'. Allowed values are: \"red\",\"green\".",
 *   "errors": [{
 *     "code": "InvalidField",
 *     "message": "The value '2' is not valid for field 'fieldNameExample'. Allowed values are: \"red\",\"green\".",
 *     "invalidValue": 2,
 *     "allowedValues": ["red","green"],
 *     "field": "fieldNameExample"
 *   }]
 * }
 * ```
 */
class ErrorResponseException extends BadRequestException
{
}
