<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "name": "",
  "module": "core",
  "action": "trycatch",
  "options": {
    "try": {
      "steps": [
        {
          "name": "",
          "module": "auth",
          "action": "restrict",
          "options": {
            "provider": "security",
            "permissions": [
              "write"
            ],
            "loginUrl": "/index.php",
            "forbiddenUrl": "/403.php"
          }
        },
        {
          "name": "",
          "module": "auth",
          "action": "logout",
          "options": {
            "provider": "security"
          },
          "output": true
        }
      ]
    }
  }
}
JSON
);
?>