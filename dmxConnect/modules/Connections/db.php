<?php
// Database Type : "PostgreSQL"
// Database Adapter : "postgres"
$exports = <<<'JSON'
{
    "name": "db",
    "module": "dbconnector",
    "action": "connect",
    "options": {
        "server": "postgres",
        "connectionString": "pgsql:host=db-postgresql-nyc3-69089-do-user-6805373-0.b.db.ondigitalocean.com;port=25060;dbname=defaultdb;user=doadmin;password=AVNS_6tzZcBuYlOqEjrgC0Bm",
        "meta"  : {}
    }
}
JSON;
?>