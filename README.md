# Symfony/Doctrine Multi Tenant Example

## Overview

This is a basic example of how to use doctrine's `wrapper_class` with Symfony.

## How it works

First of all, to start the project, you need to execute the following command:
```
docker-compose up -d --build
```

You can check how connection change dynamically with `conn` query parameter in url `localhost:17000/test?conn=db2`, depending on its values (db1, db2) available.

Important files:
* `src/Controller/DynamicConnection`: This is doctrine connection's wrapper class. This class will change the default connection.
* `config/packages/doctrine.yaml`: This file contains the definition of the `wrapper_class` in the connection.
* `src/Subscriber/DyanmicConnectionSubscriber`: This handles the received requests and changes the connection depending on a parameter.

You can find more information about that in: https://lmmartinb.dev/posts/symfony/doctrine/multi-tenant/