<?php
/**
 */

namespace Commercetools\Core\Model\Extension;

/**
 * @package Commercetools\Core\Model\Extension
 *
 * @method string getType()
 * @method AWSLambdaDestination setType(string $type = null)
 * @method string getArn()
 * @method AWSLambdaDestination setArn(string $arn = null)
 * @method string getAccessKey()
 * @method AWSLambdaDestination setAccessKey(string $accessKey = null)
 * @method string getAccessSecret()
 * @method AWSLambdaDestination setAccessSecret(string $accessSecret = null)
 */
class AWSLambdaDestination extends Destination
{
    const DESTINATION_TYPE = self::DESTINATION_AWS_LAMBDA;

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'arn' => [static::TYPE => 'string'],
            'accessKey' => [static::TYPE => 'string'],
            'accessSecret' => [static::TYPE => 'string'],
        ];
    }
}
