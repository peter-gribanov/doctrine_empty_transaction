# Reproduce empty transaction in doctrine

For more details see:
https://github.com/doctrine/doctrine2/issues/7175


## Install

```
composer install
```

Preparation DB

```
./bin/console doctrine:database:create
./bin/console doctrine:migrations:migrate -n
```
