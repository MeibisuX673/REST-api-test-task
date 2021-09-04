# REST-api-test-task

## Getting started


Launch containers

```
$ make start
```

Containers run:

- web
- nginx
- composer
- db
- adminer


Database create

```
$ make db-create
```

Start migration

```
$ make migration
```

Other commands:

```
$ make exec {container name}
```
### Check the work

Go to the address: `localhost/api/docs`

log in to the adminer: `localhost:6080`, user `root`, password `123456`, database `testapi`.
