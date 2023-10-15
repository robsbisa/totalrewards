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
            "connection": "compensation",
            "sql": {
              "type": "SELECT",
              "columns": [
                {
                  "table": "users",
                  "column": "user_id",
                  "alias": "CountId",
                  "aggregate": "COUNT"
                }
              ],
              "table": {
                "name": "users"
              },
              "primary": "user_id",
              "joins": [],
              "groupBy": [],
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
                        "default": "",
                        "primary": true,
                        "unique": true,
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
                        "unique": false,
                        "nullable": true,
                        "name": "active"
                      }
                    },
                    "operation": "="
                  },
                  {
                    "id": "users.user_type",
                    "field": "users.user_type",
                    "type": "string",
                    "operator": "equal",
                    "value": "{{'Admin'}}",
                    "data": {
                      "table": "users",
                      "column": "user_type",
                      "type": "text",
                      "columnObj": {
                        "type": "string",
                        "maxLength": 255,
                        "primary": false,
                        "unique": false,
                        "nullable": true,
                        "name": "user_type"
                      }
                    },
                    "operation": "="
                  }
                ],
                "conditional": null,
                "valid": true
              },
              "query": "SELECT COUNT(user_id) AS CountId\nFROM users\nWHERE user_id = :P1 /* {{identity}} */ AND active = :P2 /* {{1}} */ AND user_type = :P3 /* {{'Admin'}} */",
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
                },
                {
                  "operator": "equal",
                  "type": "expression",
                  "name": ":P3",
                  "value": "{{'Admin'}}"
                }
              ]
            }
          },
          "output": false,
          "meta": [
            {
              "type": "number",
              "name": "CountId"
            }
          ],
          "outputType": "object"
        },
        {
          "name": "",
          "module": "core",
          "action": "condition",
          "options": {
            "if": "{{(query.CountId!=1)}}",
            "then": {
              "steps": {
                "name": "",
                "module": "core",
                "action": "redirect",
                "options": {
                  "url": "/402.php"
                }
              }
            }
          },
          "outputType": "boolean"
        }
      ]
    }
  }
}
JSON
);
?>