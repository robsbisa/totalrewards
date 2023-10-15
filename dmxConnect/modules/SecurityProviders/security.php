<?php
$exports = <<<'JSON'
{
  "name": "security",
  "module": "auth",
  "action": "provider",
  "options": {
    "secret": "nYswZdHQMqYAIqz",
    "provider": "Database",
    "connection": "compensation",
    "users": {
      "table": "users",
      "identity": "user_id",
      "username": "email",
      "password": "encrypt_password"
    },
    "permissions": {
      "write": {
        "table": "users",
        "identity": "user_id",
        "conditions": [
          {
            "column": "active",
            "operator": "=",
            "value": "1"
          }
        ]
      },
      "Admin": {
        "table": "users",
        "identity": "user_id",
        "conditions": [
          {
            "column": "user_type",
            "operator": "=",
            "value": "Admin"
          },
          {
            "column": "active",
            "operator": "=",
            "value": "1"
          }
        ]
      }
    },
    "passwordVerify": true
  },
  "meta": [
    {
      "name": "identity",
      "type": "text"
    }
  ]
}
JSON;
?>