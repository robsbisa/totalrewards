<?php
$exports = <<<'JSON'
{
  "name": "security",
  "module": "auth",
  "action": "provider",
  "options": {
    "secret": "LmXvsjN30fOcfKi",
    "provider": "Database",
    "connection": "robcompensation",
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
          },
          {
            "column": "calculator_access",
            "operator": "=",
            "value": "1"
          }
        ]
      },
      "AdminAccess": {
        "table": "users",
        "identity": "user_id",
        "conditions": [
          {
            "column": "active",
            "operator": "=",
            "value": "1"
          },
          {
            "column": "user_type",
            "operator": "=",
            "value": "Admin"
          }
        ]
      }
    }
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