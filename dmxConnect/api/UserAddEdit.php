<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/users.php",
      "linkedForm": "FormUsersAddEdit"
    },
    "$_POST": [
      {
        "type": "text",
        "fieldName": "user_id",
        "name": "user_id"
      },
      {
        "type": "text",
        "fieldName": "firstname",
        "options": {
          "rules": {
            "core:required": {
              "param": ""
            }
          }
        },
        "name": "firstname"
      },
      {
        "type": "text",
        "fieldName": "lastname",
        "options": {
          "rules": {
            "core:required": {
              "param": ""
            }
          }
        },
        "name": "lastname"
      },
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
        "fieldName": "active",
        "options": {
          "rules": {
            "core:required": {
              "param": ""
            }
          }
        },
        "name": "active"
      },
      {
        "type": "text",
        "fieldName": "calculator_access",
        "options": {
          "rules": {
            "core:required": {
              "param": ""
            }
          }
        },
        "name": "calculator_access"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "",
      "module": "core",
      "action": "condition",
      "options": {
        "if": "{{$_POST.user_id}}",
        "then": {
          "steps": [
            {
              "name": "update",
              "module": "dbupdater",
              "action": "update",
              "options": {
                "connection": "compensation",
                "sql": {
                  "type": "update",
                  "values": [
                    {
                      "table": "users",
                      "column": "firstname",
                      "type": "text",
                      "value": "{{$_POST.firstname}}"
                    },
                    {
                      "table": "users",
                      "column": "lastname",
                      "type": "text",
                      "value": "{{$_POST.lastname}}"
                    },
                    {
                      "table": "users",
                      "column": "user_type",
                      "type": "text",
                      "value": "{{'User'}}"
                    },
                    {
                      "table": "users",
                      "column": "email",
                      "type": "text",
                      "value": "{{$_POST.email}}"
                    },
                    {
                      "table": "users",
                      "column": "encrypt_password",
                      "type": "text",
                      "value": "{{$_POST.password.sha256(NOW_UTC)}}"
                    },
                    {
                      "table": "users",
                      "column": "authcode",
                      "type": "text",
                      "value": "{{NOW_UTC}}"
                    },
                    {
                      "table": "users",
                      "column": "active",
                      "type": "number",
                      "value": "{{$_POST.active}}"
                    },
                    {
                      "table": "users",
                      "column": "blank1",
                      "type": "text",
                      "value": "{{$_POST.password}}"
                    },
                    {
                      "table": "users",
                      "column": "calculator_access",
                      "type": "number",
                      "value": "{{$_POST.calculator_access}}"
                    }
                  ],
                  "table": "users",
                  "wheres": {
                    "condition": "AND",
                    "rules": [
                      {
                        "id": "user_id",
                        "type": "double",
                        "operator": "equal",
                        "value": "{{$_POST.user_id}}",
                        "data": {
                          "column": "user_id"
                        },
                        "operation": "="
                      }
                    ]
                  },
                  "returning": "user_id",
                  "query": "UPDATE users\nSET firstname = :P1 /* {{$_POST.firstname}} */, lastname = :P2 /* {{$_POST.lastname}} */, user_type = :P3 /* {{'User'}} */, email = :P4 /* {{$_POST.email}} */, encrypt_password = :P5 /* {{$_POST.password.sha256(NOW_UTC)}} */, authcode = :P6 /* {{NOW_UTC}} */, active = :P7 /* {{$_POST.active}} */, blank1 = :P8 /* {{$_POST.password}} */, calculator_access = :P9 /* {{$_POST.calculator_access}} */\nWHERE user_id = :P10 /* {{$_POST.user_id}} */",
                  "params": [
                    {
                      "name": ":P1",
                      "type": "expression",
                      "value": "{{$_POST.firstname}}"
                    },
                    {
                      "name": ":P2",
                      "type": "expression",
                      "value": "{{$_POST.lastname}}"
                    },
                    {
                      "name": ":P3",
                      "type": "expression",
                      "value": "{{'User'}}"
                    },
                    {
                      "name": ":P4",
                      "type": "expression",
                      "value": "{{$_POST.email}}"
                    },
                    {
                      "name": ":P5",
                      "type": "expression",
                      "value": "{{$_POST.password.sha256(NOW_UTC)}}"
                    },
                    {
                      "name": ":P6",
                      "type": "expression",
                      "value": "{{NOW_UTC}}"
                    },
                    {
                      "name": ":P7",
                      "type": "expression",
                      "value": "{{$_POST.active}}"
                    },
                    {
                      "name": ":P8",
                      "type": "expression",
                      "value": "{{$_POST.password}}"
                    },
                    {
                      "name": ":P9",
                      "type": "expression",
                      "value": "{{$_POST.calculator_access}}"
                    },
                    {
                      "operator": "equal",
                      "type": "expression",
                      "name": ":P10",
                      "value": "{{$_POST.user_id}}"
                    }
                  ]
                }
              },
              "meta": [
                {
                  "name": "affected",
                  "type": "number"
                }
              ]
            },
            {
              "name": "Message",
              "module": "core",
              "action": "setvalue",
              "options": {
                "value": "Success! User Details Updated"
              },
              "meta": [],
              "output": true,
              "outputType": "text"
            }
          ]
        },
        "else": {
          "steps": [
            {
              "name": "insert",
              "module": "dbupdater",
              "action": "insert",
              "options": {
                "connection": "compensation",
                "sql": {
                  "type": "insert",
                  "values": [
                    {
                      "table": "users",
                      "column": "firstname",
                      "type": "text",
                      "value": "{{$_POST.firstname}}"
                    },
                    {
                      "table": "users",
                      "column": "lastname",
                      "type": "text",
                      "value": "{{$_POST.lastname}}"
                    },
                    {
                      "table": "users",
                      "column": "user_type",
                      "type": "text",
                      "value": "{{'User'}}"
                    },
                    {
                      "table": "users",
                      "column": "email",
                      "type": "text",
                      "value": "{{$_POST.email}}"
                    },
                    {
                      "table": "users",
                      "column": "encrypt_password",
                      "type": "text",
                      "value": "{{$_POST.password.sha256(NOW_UTC)}}"
                    },
                    {
                      "table": "users",
                      "column": "created_on",
                      "type": "text",
                      "value": "{{NOW_UTC}}"
                    },
                    {
                      "table": "users",
                      "column": "authcode",
                      "type": "text",
                      "value": "{{NOW_UTC}}"
                    },
                    {
                      "table": "users",
                      "column": "active",
                      "type": "number",
                      "value": "{{$_POST.active}}"
                    },
                    {
                      "table": "users",
                      "column": "blank1",
                      "type": "text",
                      "value": "{{$_POST.password}}"
                    },
                    {
                      "table": "users",
                      "column": "calculator_access",
                      "type": "number",
                      "value": "{{$_POST.calculator_access}}"
                    }
                  ],
                  "table": "users",
                  "returning": "user_id",
                  "query": "INSERT INTO users\n(firstname, lastname, user_type, email, encrypt_password, created_on, authcode, active, blank1, calculator_access) VALUES (:P1 /* {{$_POST.firstname}} */, :P2 /* {{$_POST.lastname}} */, :P3 /* {{'User'}} */, :P4 /* {{$_POST.email}} */, :P5 /* {{$_POST.password.sha256(NOW_UTC)}} */, :P6 /* {{NOW_UTC}} */, :P7 /* {{NOW_UTC}} */, :P8 /* {{$_POST.active}} */, :P9 /* {{$_POST.password}} */, :P10 /* {{$_POST.calculator_access}} */)",
                  "params": [
                    {
                      "name": ":P1",
                      "type": "expression",
                      "value": "{{$_POST.firstname}}"
                    },
                    {
                      "name": ":P2",
                      "type": "expression",
                      "value": "{{$_POST.lastname}}"
                    },
                    {
                      "name": ":P3",
                      "type": "expression",
                      "value": "{{'User'}}"
                    },
                    {
                      "name": ":P4",
                      "type": "expression",
                      "value": "{{$_POST.email}}"
                    },
                    {
                      "name": ":P5",
                      "type": "expression",
                      "value": "{{$_POST.password.sha256(NOW_UTC)}}"
                    },
                    {
                      "name": ":P6",
                      "type": "expression",
                      "value": "{{NOW_UTC}}"
                    },
                    {
                      "name": ":P7",
                      "type": "expression",
                      "value": "{{NOW_UTC}}"
                    },
                    {
                      "name": ":P8",
                      "type": "expression",
                      "value": "{{$_POST.active}}"
                    },
                    {
                      "name": ":P9",
                      "type": "expression",
                      "value": "{{$_POST.password}}"
                    },
                    {
                      "name": ":P10",
                      "type": "expression",
                      "value": "{{$_POST.calculator_access}}"
                    }
                  ]
                }
              },
              "meta": [
                {
                  "name": "identity",
                  "type": "text"
                },
                {
                  "name": "affected",
                  "type": "number"
                }
              ]
            },
            {
              "name": "Message",
              "module": "core",
              "action": "setvalue",
              "options": {
                "value": "Success! A New User Added"
              },
              "meta": [],
              "output": true,
              "outputType": "text"
            }
          ]
        }
      },
      "outputType": "boolean"
    }
  }
}
JSON
);
?>