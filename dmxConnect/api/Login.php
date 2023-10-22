<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/index.php",
      "linkedForm": "scFormLogin"
    },
    "$_POST": [
      {
        "type": "text",
        "fieldName": "email",
        "options": {
          "rules": {
            "core:required": {
              "param": ""
            },
            "core:email": {
              "param": ""
            }
          }
        },
        "name": "email"
      },
      {
        "type": "text",
        "fieldName": "password",
        "options": {
          "rules": {
            "core:required": {
              "param": ""
            }
          }
        },
        "name": "password"
      },
      {
        "type": "text",
        "fieldName": "remember",
        "name": "remember"
      }
    ]
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
                          "connection": "robcompensation",
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
                      "column": "authcode"
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
                        "id": "users.email",
                        "field": "users.email",
                        "type": "string",
                        "operator": "equal",
                        "value": "{{$_POST.email}}",
                        "data": {
                          "table": "users",
                          "column": "email",
                          "type": "text",
                          "columnObj": {
                            "type": "string",
                            "maxLength": 100,
                            "primary": false,
                            "nullable": false,
                            "name": "email"
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
                  "query": "SELECT authcode\nFROM users\nWHERE email = :P1 /* {{$_POST.email}} */ AND active = :P2 /* {{1}} */",
                  "params": [
                    {
                      "operator": "equal",
                      "type": "expression",
                      "name": ":P1",
                      "value": "{{$_POST.email}}"
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
                  "name": "authcode"
                }
              ],
              "outputType": "object"
            },
            {
              "name": "identity",
              "module": "auth",
              "action": "login",
              "options": {
                "provider": "security",
                "username": "{{$_POST.email}}",
                "password": "{{$_POST.password.sha256(query.authcode)}}"
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