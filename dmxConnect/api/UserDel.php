<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "user_id"
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
            "AdminAccess"
          ],
          "loginUrl": "/index.php",
          "forbiddenUrl": "/402.php"
        }
      },
      {
        "name": "delete",
        "module": "dbupdater",
        "action": "delete",
        "options": {
          "connection": "robcompensation",
          "sql": {
            "type": "delete",
            "table": "users",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "user_id",
                  "field": "user_id",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{$_GET.user_id}}",
                  "data": {
                    "column": "user_id"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "returning": "user_id",
            "query": "DELETE\nFROM users\nWHERE user_id = :P1 /* {{$_GET.user_id}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{$_GET.user_id}}"
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
      }
    ]
  }
}
JSON
);
?>