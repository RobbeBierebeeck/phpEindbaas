# phpEindbaas 



## Intro 👋


Hi there! We are students of Interactive Multimedia Design.  On this repo we are <br />
working on a web-app that allows students IMD (or MEB, ...) to share projects <br /> such as UIs, logos, branding, typography, sketches...

## Technologies we use 📟


Project is created with:

* html
* css
* javascript
* php

## What to do if vendor folder is not there 🤔
1 command to rule them all:

```
composer install
```

## Logins 🔐
Login with cloudinary:
- password: **TeamDrop@1**
- email: *dddddddrop@gmail.com*

Login gmail:
- password: **TeamDrop**
- email: *dddddddrop@gmail.com*

Login Postmark
- email: hey@localleaves.be
- password: gE2Se6HfpN3ERN
- username: dropIt

## What to add in config folder 📂
1. file **config.ini**
```
[db] 
server=localhost
database = drop
username = root
password = root
```
2. file **configCloud.php**
``` php
<?php
use Cloudinary\Configuration\Configuration;

Configuration::instance([
    'cloud' => [
        'cloud_name' => 'df5hbsklz',
        'api_key' => '627277231668949',
        'api_secret' => '9zd0V-IFmk3Wc4i33bt3O7eWNm0'],
    'url' => [
        'secure' => true]]);
```
    
## Collaborators️ 🤝

- [lukasHaentjens](https://github.com/lukasHaentjens "Named link title")
- [RobinVanOverloop](https://github.com/12345123454321 "Named link title")
- [r0808](https://github.com/r0808 "Named link title")
- [Robbe Bierebeeck](https://github.com/RobbeBierebeeck "Named link title")
