# Installation steps for Symfony 4

### Require the package

```bash
$ composer require ekyna/payum-payzen-bundle
```

### Register the bundle

Add the bundle to the kernel:

```php
// config/bundles.php
return [
    // ...
    Ekyna\Bundle\PayumPayzenBundle\EkynaPayumPayzenBundle::class => ['all' => true],
];
```

### Configure Payzen

Declare the Payzen gateway:

```yaml
# config/packages/payum.yaml
payum:
    gateways:
        ...
    
        payzen:
            factory: payzen
```

Setup the API parameters:

```yaml
# config/packages/ekyna_payum_payzen.yaml
ekyna_payum_payzen:
    api:
        ctx_mode:    'PRODUCTION'
        site_id:     '1324567890'
        certificate: '1234567890'
        endpoint:    SCELLIUS
        # Optional
        hash_mode:   'SHA256'
        directory:   '%kernel.project_dir%/var/payzen'
        debug:       true
```
