# PHP Wazuh Library
This PHP library simplifies integrating with the Wazuh API, allowing developers to connect and utilize its features easily.

### How to install

```php
composer require persgeek/wazuh
```

### How to login

```
$wazuh = new Wazuh('https://test.com');

$wazuh->setUsername($username)
    ->setPassword($password);

$token = $wazuh->login()
    ->getToken();
```

### Get list of agents

```php
$wazuh->setToken($token);

$agents = $wazuh->getAgents()
    ->getItems();
```

### Assign agent to group

```php
$wazuh->setToken($token);

$message = $wazuh->assignGroup($agentId, $groupId)
    ->getMessage();
```