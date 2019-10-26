# An extender for Laravel core validation rules

This repository contains some useful Laravel validation rules.

## Available rules

- [`Phone`](#phone)

### `Phone`

Determine if the field under validation is a valid brazilian phone number (cellphone or landline).

```php
// in a `FormRequest`

public function rules()
{
    return [
        'phone_number' => ['required', 'phone'],
    ];
}
```
