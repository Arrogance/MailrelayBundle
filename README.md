# MailrelayBundle - 1.0@dev - [![Build Status](https://travis-ci.org/Arrogance/MailrelayBundle.svg?branch=master)](https://travis-ci.org/Arrogance/MailrelayBundle) [![Packagist](https://img.shields.io/packagist/dt/Arrogance/mailrelay-bundle.svg)]() [![Packagist](https://img.shields.io/packagist/v/Arrogance/mailrelay-bundle.svg)]()
A bundle to send, track and manage emails sent with Mailrelay.com.

_Attention: This bundle is under a high development, wiki and instructions ***may be*** incomplete or inexistent yet. Use it under your very own discretion and responsibility._

## How to Install
Use composer to install the bundle:
```bash
$ composer require arrogance/mailrelay-bundle ^1.0
```

Load the bundle in `AppKernel.php`:
```php
    $bundles = array(
        // ...
        new Arrogance\MailrelayBundle\ArroganceMailrelayBundle(),
    );
```

### Configure
Add in `parameters.yml` file:
```yml
    mailrelay_apikey: YourAPIKey
    mailrelay_access_point: yourUser.ip-zone.com
```
and/or `config.yml`:
```yml
arrogance_mailrelay:
    api_key: "%mailrelay_apikey%"
    access_point: "%mailrelay_access_point%"
```

## Quick Start
#### Send Email
```php
use Arrogance\MailrelayBundle\Email;
// ...
$client = $this->get('arrogance_mailrelay.client');

$email = new Email\Email();
$email->addEmail('test@test.io', 'Your recipìent')
    ->addEmail('another@test.io')
    ->setSubject('Email de prueba desde la API')
    ->setHtml($this->get('twig')->render('@YourBundle/Default/email.html.twig', array()))
    ->setFromId(1)
    ->setReplyId(1)
    ->setReportId(1)
    ->setPackageId(6);

// Mailrelay response
$response = $client->sendMail($email);
```
### [View full documentation](https://github.com/Arrogance/MailrelayBundle/wiki/Documentation)

## License
The MIT License (MIT)

Copyright (c) 2016 Manuel Raya <manuel@arrogance.es>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
