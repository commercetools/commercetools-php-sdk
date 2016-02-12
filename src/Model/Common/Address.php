<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 11.02.15, 15:37
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://dev.commercetools.com/http-api-types.html#address
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
 */
class Address extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'id' => [self::TYPE => 'string'],
            'title' => [self::TYPE => 'string'],
            'salutation' => [self::TYPE => 'string'],
            'firstName' => [self::TYPE => 'string'],
            'lastName' => [self::TYPE => 'string'],
            'streetName' => [self::TYPE => 'string'],
            'streetNumber' => [self::TYPE => 'string'],
            'additionalStreetInfo' => [self::TYPE => 'string'],
            'postalCode' => [self::TYPE => 'string'],
            'city' => [self::TYPE => 'string'],
            'region' => [self::TYPE => 'string'],
            'state' => [self::TYPE => 'string'],
            'country' => [self::TYPE => 'string'],
            'company' => [self::TYPE => 'string'],
            'department' => [self::TYPE => 'string'],
            'building' => [self::TYPE => 'string'],
            'apartment' => [self::TYPE => 'string'],
            'pOBox' => [self::TYPE => 'string'],
            'phone' => [self::TYPE => 'string'],
            'mobile' => [self::TYPE => 'string'],
            'email' => [self::TYPE => 'string'],
            'additionalAddressInfo' => [self::TYPE => 'string'],
        ];
    }
}
