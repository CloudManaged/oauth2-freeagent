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
        $this->url = $attributes['url'];
        $this->name = $attributes['name'];
        $this->subdomain = $attributes['subdomain'];
        $this->type = $attributes['type'];
        $this->currency = $attributes['currency'];
        $this->mileage_units = $attributes['mileage_units'];
        $this->company_start_date = isset($attributes['company_start_date']) ? $attributes['company_start_date'] : null;
        $this->freeagent_start_date = isset($attributes['freeagent_start_date']) ? $attributes['freeagent_start_date'] : null;
        $this->first_accounting_year_end = isset($attributes['first_accounting_year_end']) ? $attributes['first_accounting_year_end'] : null;
        $this->company_registration_number = isset($attributes['company_registration_number']) ? $attributes['company_registration_number'] : null;
        $this->sales_tax_registration_status = isset($attributes['sales_tax_registration_status']) ? $attributes['sales_tax_registration_status'] : null;
        $this->sales_tax_name = isset($attributes['sales_tax_name']) ? $attributes['sales_tax_name'] : null;
        $this->sales_tax_registration_number = isset($attributes['sales_tax_registration_number']) ? $attributes['sales_tax_registration_number'] : null;
        $this->sales_tax_rates = isset($attributes['sales_tax_rates']) ? $attributes['sales_tax_rates'] : null;
        $this->sales_tax_is_value_added = isset($attributes['sales_tax_is_value_added']) ? $attributes['sales_tax_is_value_added'] : null;
        $this->supports_auto_sales_tax_on_purchases = isset($attributes['supports_auto_sales_tax_on_purchases']) ? $attributes['supports_auto_sales_tax_on_purchases'] : null;
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
