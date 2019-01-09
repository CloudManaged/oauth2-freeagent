<?php

namespace CloudManaged\OAuth2\Client\Entity;

/**
 * Class Company
 *
 * url
 * name
 * subdomain
 * type
 * currency
 * mileage_units
 * company_start_date
 * freeagent_start_date
 * first_accounting_year_end
 * company_registration_number
 * sales_tax_registration_status
 * sales_tax_name
 * sales_tax_registration_number
 * sales_tax_rates
 * sales_tax_is_value_added
 * supports_auto_sales_tax_on_purchases
 *
 * @package CloudManaged\OAuth2\Client\Entity
 * @author Israel Sotomayor <israel@contactzilla.com>
 */
class Company
{
    public $url;
    public $name;
    public $subdomain;
    public $type;
    public $currency;
    public $mileage_units;
    public $company_start_date;
    public $freeagent_start_date;
    public $first_accounting_year_end;
    public $company_registration_number;
    public $sales_tax_registration_status;
    public $sales_tax_name;
    public $sales_tax_registration_number;
    public $sales_tax_rates;
    public $sales_tax_is_value_added;
    public $supports_auto_sales_tax_on_purchases;

    public function __construct(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if (property_exists(__CLASS__, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'company_registration_number' => $this->company_registration_number
        ];
    }

    public function toString()
    {
        return $this->name;
    }
}
