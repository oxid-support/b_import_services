
## Install

```
git clone https://github.com/oxid-support/b_import_services

composer config minimum-stability dev
composer config repositories.oxid-support/event path b_import_services/oxs/event
composer require oxid-support/event

vendor/bin/oe-console oe:module:activate oxs_event
```
