# Installation steps for Symfony 3 

### Require the package

```bash
$ composer require ekyna/payum-payzen-bundle
```

### Register the bundle

Add the bundle to the kernel:

```php
// app/Kernel.php
public function registerBundles()
{
    $bundles = [
        // ...
        new \Ekyna\Bundle\PayumPayzenBundle\EkynaPayumPayzenBundle(),
    ];
    
    // ...
}
```

### Configure Payzen

Declare the Payzen gateway:

```yaml
# app/config/config.yml
payum:
    gateways:
        ...
    
        payzen:
            factory: payzen
```

Configure the API parameters:

```yaml
# app/config/config.yml
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
