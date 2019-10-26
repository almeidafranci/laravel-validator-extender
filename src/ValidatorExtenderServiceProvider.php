<?php

namespace AlmeidaFranci\LaravelValidatorExtender;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidatorExtenderServiceProvider extends ServiceProvider
{
    private const VALIDATOR_CLASS = __NAMESPACE__.'\ValidatorExtension';

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend(
            'phone',
            self::VALIDATOR_CLASS.'@validatePhone',
            'Phone number is invalid'
        );

        Validator::extend(
            'cpf',
            self::VALIDATOR_CLASS.'@validateCpf',
            'CPF is invalid'
        );

        Validator::extend(
            'cnpj',
            self::VALIDATOR_CLASS.'@validateCnpj',
            'CNPJ is invalid'
        );

        Validator::extend(
            'cpf_or_cnpj',
            self::VALIDATOR_CLASS.'@validateCpfOrCnpj',
            'Invalid CPF or CNPJ'
        );

        Validator::extend(
            'zip',
            self::VALIDATOR_CLASS.'@validateZip',
            'ZIP code is invalid'
        );

        Validator::extend(
            'ip_range',
            self::VALIDATOR_CLASS.'@validateIpRange',
            'IP range is invalid'
        );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
