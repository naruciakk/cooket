<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Pole :attribute musi zostać zaakceptowane.',
    'active_url'           => 'Podany URL (:attribute) nie jest prawidłowy.',
    'after'                => 'Pole :attribute musi zawierać datę po :date.',
    'alpha'                => 'Pole :attribute może zawierać tylko litery.',
    'alpha_dash'           => 'Pole :attribute może zawierać tylko litery, cyfry i ukośniki',
    'alpha_num'            => 'Pole :attribute może zawierać tylko litery i cyfry',
    'array'                => 'Pole :attribute musi być zbiorem.',
    'before'               => 'Pole :attribute musi zawierać datę przed :date.',
    'between'              => [
        'numeric' => 'Zawartość pola :attribute musi być pomiędzy :min i :max.',
        'file'    => 'Plik musi mieć wielkość między :min i :max kilobajtów.',
        'string'  => 'Ciąg znaków musi zawierać od :min do :max znaków.',
        'array'   => 'Pole :attribute musi zawierać od :min do :max elementów.',
    ],
    'boolean'              => 'Pole :attribute musi być albo prawdą, albo fałszem.',
    'confirmed'            => 'Pole :attribute nie zostało zatwierdzone.',
    'date'                 => 'Pole :attribute nie zawiera poprawnej daty.',
    'date_format'          => 'Pole :attribute nie zawiera daty w prawidłowym formacie.',
    'different'            => 'Pole :attribute i :other muszą być różne.',
    'digits'               => 'Pole :attribute musi zawierać :digits cyfr.',
    'digits_between'       => 'Pole :attribute musi zawirać od :min do :max cyfr.',
    'distinct'             => 'Wartość pola :attribute jest zduplikowana.',
    'email'                => 'Pole :attribute nie zawiera poprawnego adresu email.',
    'exists'               => 'Zaznaczone pole :attribute jest nieprawidłowe.',
    'filled'               => 'Pole :attribute jest wymagane.',
    'image'                => 'Pole :attribute musi być obrazem.',
    'in'                   => 'Zaznaczone pole :attribute jest nieprawidłowe.',
    'in_array'             => 'Pole :attribute nie zawiera się w :other.',
    'integer'              => 'Pole :attribute musi być liczbą całkowitą.',
    'ip'                   => 'Pole :attribute musi być poprawnym adresem IP.',
    'json'                 => 'Pole :attribute musi być poprawnym dokumentem JSON',
    'max'                  => [
        'numeric' => 'Liczba nie może być większa niż :max.',
        'file'    => 'Plik nie może być większy niż :max kilobajtów.',
        'string'  => 'Ciąg znaków nie może być dłuższy niż :max znaków.',
        'array'   => 'Pole nie może zawierać więcej niż :max elementów.',
    ],
    'mimes'                => 'W polu :attribute powinien znaleźć się plik jednego z następujących typów: :values.',
    'min'                  => [
        'numeric' => 'Liczba nie może być mniejsza niż :min.',
        'file'    => 'Plik nie może być większy niż :min kilobajtów.',
        'string'  => 'Ciąg znaków musi zawirać co najmniej :min znaków.',
        'array'   => 'Pole nie może zawierać mniej niż :min elementów.',
    ],
    'not_in'               => 'Zaznaczone pole :attribute jest nieprawidłowe.',
    'numeric'              => 'Pole :attribute musi być liczbą.',
    'present'              => 'Pole :attribute musi być obecne.',
    'regex'                => 'Pole :attribute ma nieprawidłowy format.',
    'required'             => 'Pole :attribute jest wymagane.',
    'required_if'          => 'Pole :attribute jest wymagane jeżeli :other ma wartość :value.',
    'required_unless'      => 'Pole :attribute jest wymagane jeżeli :other nie zawiera się w :values.',
    'required_with'        => 'Pole :attribute jest wymagane jeżeli którakolwiek wartość z :values jest obecna.',
    'required_with_all'    => 'Pole :attribute jest wymagane jeżeli wszytkie wartości z :values są obecne.',
    'required_without'     => 'Pole :attribute jest wymagane jeżeli którakolwiek wartość z :values nie jest obecna.',
    'required_without_all' => 'Pole :attribute jest wymagane jeżeli wszystkie wartości z :values są nieobecne.',
    'same'                 => 'Pole :attribute i :other muszą się pokrywać.',
    'size'                 => [
        'numeric' => 'Zawartość pola :attribute musi być rozmiaru :size.',
        'file'    => 'Plik musi mieć rozmiar :size kilobajtów.',
        'string'  => 'Ciąg znaków musi zawierać dokładnie  :size znaków.',
        'array'   => 'Pole :attribute musi zawierać dokładnie :size elementów.',
    ],
    'string'               => 'Pole :attribute musi być ciągiem znaków.',
    'timezone'             => 'Pole :attribute musi być poprawną strefą czasową.',
    'unique'               => 'Pole :attribute zostao już wcześniej wybrane.',
    'url'                  => 'Pole :attribute nie zawiera adresu URL w odpowiednim formacie.',
    'passWrong'            => 'Podane (stare) hasło jest nieprawidłowe.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
