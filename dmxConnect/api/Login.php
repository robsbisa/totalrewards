<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/index.php",
      "linkedForm": "scFormLogin"
    }
  },
  "exec": {
    "steps": {
      "name": "",
      "module": "core",
      "action": "trycatch",
      "options": {
        "try": {
          "steps": [
            {
              "name": "validate",
              "module": "validator",
              "action": "validate",
              "options": {
                "data": [
                  {
                    "name": "validate_1",
                    "value": "{{$_POST.email}}",
                    "rules": {
                      "db:exists": {
                        "param": {
                          "connection": "compensation",
                          "table": "users",
                          "column": "email"
                        }
                      }
                    }
                  }
                ]
              }
            },
            {
              "name": "custom",
              "module": "dbupdater",
              "action": "custom",
              "options": {
                "connection": "compensation",
                "sql": {
                  "query": "SELECT authcode as salt\nFROM users\nWHERE email = @email AND active = 1;",
                  "params": [
                    {
                      "name": "@email",
                      "value": "{{$_POST.email}}",
                      "test": "hardy.john@example.com"
                    }
                  ]
                }
              },
              "output": false,
              "meta": [
                {
                  "name": "salt",
                  "type": "text"
                }
              ],
              "outputType": "array"
            },
            {
              "name": "identity",
              "module": "auth",
              "action": "login",
              "options": {
                "provider": "security",
                "username": "{{$_POST.email}}",
                "password": "{{$_POST.password.sha256(custom[0].salt)}}"
              },
              "output": false,
              "meta": []
            }
          ]
        }
      }
    }
  }
}
JSON
);
?>