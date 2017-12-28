<?php

namespace Taskly\Transformers;

use League\Fractal\TransformerAbstract;

use Taskly\Company;

class CompanyTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Company $company)
    {
        return [
            'company_name'              => (string) $company->company_name,
            'company_type'              => (string) $company->company_type,
            'company_address'           => (string) $company->company_address,
            'company_registration_nr'   => (string) $company->company_registration_nr,
            'company_phone_nr'          => (string) $company->company_phone_nr
        ];
    }
}
