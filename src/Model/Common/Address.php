<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 11.02.15, 15:37
 */

namespace Sphere\Core\Model\Common;

/**
 * Class Address
 * @package Sphere\Core\Model\Common
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
 * @method Address setId(string $id)
 * @method Address setTitle(string $title)
 * @method Address setSalutation(string $salutation)
 * @method Address setFirstName(string $firstName)
 * @method Address setLastName(string $lastName)
 * @method Address setStreetName(string $streetName)
 * @method Address setStreetNumber(string $streetNumber)
 * @method Address setAdditionalStreetInfo(string $additionalStreetInfo)
 * @method Address setPostalCode(string $postalCode)
 * @method Address setCity(string $city)
 * @method Address setRegion(string $region)
 * @method Address setState(string $state)
 * @method Address setCountry(string $country)
 * @method Address setCompany(string $company)
 * @method Address setDepartment(string $department)
 * @method Address setBuilding(string $building)
 * @method Address setApartment(string $apartment)
 * @method Address setPOBox(string $pOBox)
 * @method Address setPhone(string $phone)
 * @method Address setMobile(string $mobile)
 * @method Address setEmail(string $email)
 * @method Address setAdditionalAddressInfo(string $additionalAddressInfo)
 */
class Address extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [self::TYPE => 'string', static::OPTIONAL],
            'title' => [self::TYPE => 'string', static::OPTIONAL],
            'salutation' => [self::TYPE => 'string', static::OPTIONAL],
            'firstName' => [self::TYPE => 'string', static::OPTIONAL],
            'lastName' => [self::TYPE => 'string', static::OPTIONAL],
            'streetName' => [self::TYPE => 'string', static::OPTIONAL],
            'streetNumber' => [self::TYPE => 'string', static::OPTIONAL],
            'additionalStreetInfo' => [self::TYPE => 'string', static::OPTIONAL],
            'postalCode' => [self::TYPE => 'string', static::OPTIONAL],
            'city' => [self::TYPE => 'string', static::OPTIONAL],
            'region' => [self::TYPE => 'string', static::OPTIONAL],
            'state' => [self::TYPE => 'string', static::OPTIONAL],
            'country' => [self::TYPE => 'string', static::OPTIONAL],
            'company' => [self::TYPE => 'string', static::OPTIONAL],
            'department' => [self::TYPE => 'string', static::OPTIONAL],
            'building' => [self::TYPE => 'string', static::OPTIONAL],
            'apartment' => [self::TYPE => 'string', static::OPTIONAL],
            'pOBox' => [self::TYPE => 'string', static::OPTIONAL],
            'phone' => [self::TYPE => 'string', static::OPTIONAL],
            'mobile' => [self::TYPE => 'string', static::OPTIONAL],
            'email' => [self::TYPE => 'string', static::OPTIONAL],
            'additionalAddressInfo' => [self::TYPE => 'string', static::OPTIONAL],
        ];
    }
}
