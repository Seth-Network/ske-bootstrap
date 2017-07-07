# Bootstrapping project for Seth Kohana Extensions

## Prerequisites

Following programs are required:

* PHP 7+
* Composer 1.4+

## How to use?

Download and unzip the source repository, or clone it using Git:

```
git clone https://github.com/Seth-Network/ske-bootstrap.git
```

Open a terminal window, go to the downloaded/cloned task's source folder and let composer download all requirements:

```
composer install
``` 

If you like to setup the SKE environment you can use available composer script to do so:

```
composer run-script init-ske
``` 

The script will create an application folder with all required subdirectories and configure SKE module correctly.
You may now proceed by verifying the installing by opening an browser window on public/index.php or continue
working with the minion CLI.

Following command will show available minions:

```
./minion
``` 