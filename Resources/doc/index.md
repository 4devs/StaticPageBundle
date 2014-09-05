Getting Started With StaticPageBundle
===========================================

## Installation and usage

Installation and usage is a quick:

1. Download StaticPageBundle using composer
2. Enable the Bundle
3. Use the bundle


### Step 1: Download StaticPageBundle using composer

Add StaticPageBundle in your composer.json:

```js
{
    "require": {
        "fdevs/static-page-bundle": "*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update fdevs/static-page-bundle
```

Composer will install the bundle to your project's `vendor/fdevs` directory.


### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new FDevs\StaticPageBundle\FDevsStaticPageBundle(),
    );
}
```

add config

``` yaml
# app/config/config.yml
f_devs_static_page:
    admin_service: 'sonata'
    pages:
        contact:
            type: '_template'
            value: "AcmeDemoBundle:Default:contact.html.twig"
        home:
            type: '_controller'
            value: "AcmeDemoBundle:Default:index"

sonata_admin:
    dashboard:
        groups:
            label.pages:
                label_catalogue: AcmeDemoBundle
                items:
                    - f_devs_static_page.sonata.admin.static
```

### Step 3: Use the bundle

create template AcmeDemoBundle:Default:contact.html.twig

``` twig
{% extends '::base.html.twig' %}
{% block stylesheets %}{% endblock %}
{% block title %}{{ cmfMainContent.title|t ~ ' :: ' ~ parent() }}{% endblock %}
{% block javascripts %}<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>{% endblock %}
{% block body %}
    {{ cmfMainContent.description|t }}
{% endblock %}
```

or use controller

``` php
//src/Acme/DemoBundle/Controller/DefaultController.php

class DefaultController extends Controller
{

    public function indexAction(Request $request, $contentDocument = null)
    {
        #....

        return $this->render('AcmeDemoBundle:Default:index.html.twig', ['content' => $contentDocument]);
    }
}
```
