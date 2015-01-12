<?php

namespace Contactzilla\OAuth2\Client\Entity;

/**
 * Class Contact
 *
 * organisation_name (Required if either first_name or last_name are empty)
 * first_name (Required if organisation_name is empty)
 * last_name (Required if organisation_name is empty)
 * email
 * phone_number
 * address1
 * town
 * region
 * postcode
 * address2
 * address3
 * contact_name_on_invoices
 * country
 * sales_tax_registration_number
 * uses_contact_invoice_sequence
 *
 * @package Contactzilla\OAuth2\Client\Entity
 * @author Israel Sotomayor <israel@contactzilla.com>
 */
class Contact
{
    public $organisation_name;
    public $first_name;
    public $last_name;
    public $email;
    public $phone_number;
    public $address1;
    public $town;
    public $region;
    public $postcode;
    public $address2;
    public $address3;
    public $contact_name_on_invoices;
    public $country;
    public $sales_tax_registration_number;
    public $uses_contact_invoice_sequence;

    public function __construct(array $attributes)
    {
        $this->organisation_name = isset($attributes['organisation_name']) ? $attributes['organisation_name'] : null;
        $this->first_name = isset($attributes['first_name']) ? $attributes['first_name'] : null;
        $this->last_name = isset($attributes['last_name']) ? $attributes['last_name'] : null;
        $this->email = $attributes['email'];
        $this->phone_number = $attributes['phone_number'];
        $this->address1 = $attributes['address1'];
        $this->town = $attributes['town'];
        $this->region = $attributes['region'];
        $this->postcode = $attributes['postcode'];
        $this->address2 = $attributes['address2'];
        $this->address3 = $attributes['address3'];
        $this->contact_name_on_invoices = $attributes['contact_name_on_invoices'];
        $this->country = $attributes['country'];
        $this->sales_tax_registration_number = $attributes['sales_tax_registration_number'];
        $this->uses_contact_invoice_sequence = $attributes['uses_contact_invoice_sequence'];
    }

    public function toArray()
    {
        if (isset($this->organisation_name)) {
            return ['organisation_name' => $this->organisation_name];
        }

        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name
        ];
    }

    public function toString()
    {
        if (isset($this->organisation_name)) {
            return $this->organisation_name;
        }

        return $this->first_name . ' ' . $this->last_name;
    }
}
