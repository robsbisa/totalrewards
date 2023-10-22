<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "offset"
      },
      {
        "type": "text",
        "name": "limit"
      },
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ]
  },
  "exec": {
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
        },
        "disabled": true
      },
      {
        "name": "query",
        "module": "dbconnector",
        "action": "paged",
        "options": {
          "connection": "compensation",
          "sql": {
            "type": "SELECT",
            "columns": [
              {
                "table": "users",
                "column": "user_id"
              },
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
              },
              {
                "table": "users",
                "column": "email"
              },
              {
                "table": "users",
                "column": "calculator_access"
              },
              {
                "table": "users",
                "column": "active"
              },
              {
                "table": "users",
                "column": "created_on"
              },
              {
                "table": "users",
                "column": "blank1"
              }
            ],
            "table": {
              "name": "users"
            },
            "primary": "user_id",
            "joins": [],
            "orders": [
              {
                "table": "users",
                "column": "user_id",
                "direction": "DESC",
                "recid": 1
              }
            ],
            "query": "SELECT user_id, firstname, lastname, user_type, email, calculator_access, active, created_on, blank1\nFROM users\nORDER BY user_id DESC",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "offset",
            "type": "number"
          },
          {
            "name": "limit",
            "type": "number"
          },
          {
            "name": "total",
            "type": "number"
          },
          {
            "name": "page",
            "type": "object",
            "sub": [
              {
                "name": "offset",
                "type": "object",
                "sub": [
                  {
                    "name": "first",
                    "type": "number"
                  },
                  {
                    "name": "prev",
                    "type": "number"
                  },
                  {
                    "name": "next",
                    "type": "number"
                  },
                  {
                    "name": "last",
                    "type": "number"
                  }
                ]
              },
              {
                "name": "current",
                "type": "number"
              },
              {
                "name": "total",
                "type": "number"
              }
            ]
          },
          {
            "name": "data",
            "type": "array",
            "sub": [
              {
                "type": "number",
                "name": "user_id"
              },
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
              },
              {
                "type": "text",
                "name": "email"
              },
              {
                "type": "number",
                "name": "calculator_access"
              },
              {
                "type": "number",
                "name": "active"
              },
              {
                "type": "datetime",
                "name": "created_on"
              },
              {
                "type": "text",
                "name": "blank1"
              }
            ]
          }
        ],
        "outputType": "object"
      }
    ]
  }
}
JSON
);
?>