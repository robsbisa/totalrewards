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
            "forbiddenUrl": "/402.php"
          }
        },
        {
          "name": "identity",
          "module": "auth",
          "action": "identify",
          "options": {
            "provider": "security"
          },
          "output": false,
          "meta": []
        },
        {
          "name": "query",
          "module": "dbconnector",
          "action": "single",
          "options": {
            "connection": "robcompensation",
            "sql": {
              "type": "SELECT",
              "columns": [
                {
                  "table": "users",
                  "column": "firstname"
                },
                {
                  "table": "users",
                  "column": "lastname"
                },
                {
                  "table": "users",
                  "column": "user_type"
                }
              ],
              "table": {
                "name": "users"
              },
              "primary": "user_id",
              "joins": [],
              "wheres": {
                "condition": "AND",
                "rules": [
                  {
                    "id": "users.user_id",
                    "field": "users.user_id",
                    "type": "double",
                    "operator": "equal",
                    "value": "{{identity}}",
                    "data": {
                      "table": "users",
                      "column": "user_id",
                      "type": "number",
                      "columnObj": {
                        "type": "increments",
                        "primary": true,
                        "nullable": false,
                        "name": "user_id"
                      }
                    },
                    "operation": "="
                  },
                  {
                    "id": "users.active",
                    "field": "users.active",
                    "type": "double",
                    "operator": "equal",
                    "value": "{{1}}",
                    "data": {
                      "table": "users",
                      "column": "active",
                      "type": "number",
                      "columnObj": {
                        "type": "integer",
                        "primary": false,
                        "nullable": false,
                        "name": "active"
                      }
                    },
                    "operation": "="
                  }
                ],
                "conditional": null,
                "valid": true
              },
              "query": "SELECT firstname, lastname, user_type\nFROM users\nWHERE user_id = :P1 /* {{identity}} */ AND active = :P2 /* {{1}} */",
              "params": [
                {
                  "operator": "equal",
                  "type": "expression",
                  "name": ":P1",
                  "value": "{{identity}}"
                },
                {
                  "operator": "equal",
                  "type": "expression",
                  "name": ":P2",
                  "value": "{{1}}"
                }
              ]
            }
          },
          "output": true,
          "meta": [
            {
              "type": "text",
              "name": "firstname"
            },
            {
              "type": "text",
              "name": "lastname"
            },
            {
              "type": "text",
              "name": "user_type"
            }
          ],
          "outputType": "object"
        }
      ]
    }
  }
}
JSON
);
?>