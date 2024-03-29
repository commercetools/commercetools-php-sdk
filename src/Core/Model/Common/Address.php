<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 11.02.15, 15:37
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\CustomField\CustomFieldObject;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://docs.commercetools.com/http-api-types.html#address
 * @method string getId()
 * @method string getTitle()
 * @method string getSalutation()
 * @method string getFirstName()
 * @method string getLastName()
 * @method string getStreetName()
 * @method string getStreetNumber()
 * @method string getAdditionalStreetInfo()
 * @method string getPostalCode()
 * @method string getCity()
 * @method string getRegion()
 * @method string getState()
 * @method string getCountry()
 * @method string getCompany()
 * @method string getDepartment()
 * @method string getBuilding()
 * @method string getApartment()
 * @method string getPOBox()
 * @method string getPhone()
 * @method string getMobile()
 * @method string getEmail()
 * @method string getAdditionalAddressInfo()
 * @method Address setId(string $id = null)
 * @method Address setTitle(string $title = null)
 * @method Address setSalutation(string $salutation = null)
 * @method Address setFirstName(string $firstName = null)
 * @method Address setLastName(string $lastName = null)
 * @method Address setStreetName(string $streetName = null)
 * @method Address setStreetNumber(string $streetNumber = null)
 * @method Address setAdditionalStreetInfo(string $additionalStreetInfo = null)
 * @method Address setPostalCode(string $postalCode = null)
 * @method Address setCity(string $city = null)
 * @method Address setRegion(string $region = null)
 * @method Address setState(string $state = null)
 * @method Address setCountry(string $country = null)
 * @method Address setCompany(string $company = null)
 * @method Address setDepartment(string $department = null)
 * @method Address setBuilding(string $building = null)
 * @method Address setApartment(string $apartment = null)
 * @method Address setPOBox(string $pOBox = null)
 * @method Address setPhone(string $phone = null)
 * @method Address setMobile(string $mobile = null)
 * @method Address setEmail(string $email = null)
 * @method Address setAdditionalAddressInfo(string $additionalAddressInfo = null)
 * @method string getFax()
 * @method Address setFax(string $fax = null)
 * @method string getExternalId()
 * @method Address setExternalId(string $externalId = null)
 * @method string getKey()
 * @method Address setKey(string $key = null)
 * @method CustomFieldObject getCustom()
 * @method Address setCustom(CustomFieldObject $custom = null)
 */
class Address extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [self::TYPE => 'string', self::OPTIONAL => true],
            'key' => [self::TYPE => 'string', self::OPTIONAL => true],
            'title' => [self::TYPE => 'string', self::OPTIONAL => true],
            'salutation' => [self::TYPE => 'string', self::OPTIONAL => true],
            'firstName' => [self::TYPE => 'string', self::OPTIONAL => true],
            'lastName' => [self::TYPE => 'string', self::OPTIONAL => true],
            'streetName' => [self::TYPE => 'string', self::OPTIONAL => true],
            'streetNumber' => [self::TYPE => 'string', self::OPTIONAL => true],
            'additionalStreetInfo' => [self::TYPE => 'string', self::OPTIONAL => true],
            'postalCode' => [self::TYPE => 'string', self::OPTIONAL => true],
            'city' => [self::TYPE => 'string', self::OPTIONAL => true],
            'region' => [self::TYPE => 'string', self::OPTIONAL => true],
            'state' => [self::TYPE => 'string', self::OPTIONAL => true],
            'country' => [self::TYPE => 'string'],
            'company' => [self::TYPE => 'string', self::OPTIONAL => true],
            'department' => [self::TYPE => 'string', self::OPTIONAL => true],
            'building' => [self::TYPE => 'string', self::OPTIONAL => true],
            'apartment' => [self::TYPE => 'string', self::OPTIONAL => true],
            'pOBox' => [self::TYPE => 'string', self::OPTIONAL => true],
            'phone' => [self::TYPE => 'string', self::OPTIONAL => true],
            'mobile' => [self::TYPE => 'string', self::OPTIONAL => true],
            'email' => [self::TYPE => 'string', self::OPTIONAL => true],
            'additionalAddressInfo' => [self::TYPE => 'string', self::OPTIONAL => true],
            'fax' => [static::TYPE => 'string', self::OPTIONAL => true],
            'externalId' => [static::TYPE => 'string', self::OPTIONAL => true],
            'custom' => [static::TYPE => CustomFieldObject::class, self::OPTIONAL => true]
        ];
    }
}
