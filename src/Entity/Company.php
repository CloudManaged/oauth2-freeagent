<?php

namespace Contactzilla\OAuth2\Client\Entity;

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
        $this->company_start_date = $attributes['company_start_date'];
        $this->freeagent_start_date = $attributes['freeagent_start_date'];
        $this->first_accounting_year_end = $attributes['first_accounting_year_end'];
        $this->company_registration_number = $attributes['company_registration_number'];
        $this->sales_tax_registration_status = $attributes['sales_tax_registration_status'];
        $this->sales_tax_name = $attributes['sales_tax_name'];
        $this->sales_tax_registration_number = $attributes['sales_tax_registration_number'];
        $this->sales_tax_rates = $attributes['sales_tax_rates'];
        $this->sales_tax_is_value_added = $attributes['sales_tax_is_value_added'];
        $this->supports_auto_sales_tax_on_purchases = $attributes['supports_auto_sales_tax_on_purchases'];
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
