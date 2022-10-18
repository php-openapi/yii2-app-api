Getting started with a new API
==============================

After setting up the project as described in [README.md under "Setup"](../README.md#setup-) you
can follow this guide to get started with your API.

## Create the OpenAPI description file

If you don't have an OpenAPI description already you should first create one.
Working with this project template you are following the
[Design-First-Approach](https://apisyouwonthate.com/blog/api-design-first-vs-code-first),
so before you write any code, you are creating an API description.

You are free to choose the path and file name where you want to put your OpenAPI description file.
In this guide we are placing all OpenAPI files in the `openapi` directory.
Our API description is in `openapi/schema.yaml`.
If you choose another file location, you need to take that into account when configuring the generator
in the next step.

If you don't know how to create OpenAPI descriptions you can check out the following resources:

  - <https://oai.github.io/Documentation/start-here.html>
  - ... (if you happen to know better resources to look at, please [let us know](https://github.com/cebe/yii2-app-api/issues/new)

Also check out the [OpenAPI Specification](https://spec.openapis.org/oas/v3.1.0) itself.


## Configure the Code Generator

The Code Generator (based on [Gii](https://www.yiiframework.com/doc/guide/2.0/en/start-gii), the Yii Framework code generator) generates the Database, Model classes, API Controllers and routing rules based on the OpenAPI description file.

The Code Generator configuration is located in `config/gii-generators.php`.

The first thing to configure for a new project is the `openApiPath` setting, which tells the generator where to look for the OpenAPI description file:

```php
return [
    'api' => [
        // ... keep existing settings, add the OpenAPI file:
            
        'openApiPath' => '@root/openapi/schema.yaml',
    ],
];
```

You may run `./yii gii/api --help` for a list of configuration options.
All options may be specified as command line options or in the configuration file `config/gii-generators.php`.


## Generate Code

At this point you should have started the application server, we assume you are using the Docker environment here, so all commands are run after running `make start-docker` and `make cli`.

Run the code generator:

    ./yii gii/api

This command checks the OpenAPI description and compares it to the existing database. On the first run it will generate migrations to create all mising tables. If you want to run it again you always need to apply these migrations to make sure the generator compares to the current state of the database. Otherwise it would generate the same migrations again.

Apply migrations with:

    ./yii migrate/up

The generator also creates Fake data generators. These can be run using the following command:

    ./yii faker

The fake data is based on guesses, in many cases you'd want to adjust the faker to produce more accurate data. You can do that by adding the `x-faker` property to your OpenAPI schema. This is an OpenAPI extension provided by the [yii2-openapi](https://github.com/cebe/yii2-openapi) package.

You can find more information on OpenAPI extensions the [README](https://github.com/cebe/yii2-openapi#openapi-extensions) of that package.

### Making changes to the specification

To add more Models/Tables or Paths you first adjust your OpenAPI description and then run the generator again. Make sure all migrations have been applied before that.

    ./yii gii/api

This will update the existing Models and Controllers and also create migrations for the changes that are made to the database.

It is important to check the migrations manually, for example if you rename columns it will create drop column and create column instaead of rename which may result in data loss.

For each Model and Controller you have a base class that is controlled by the Generator, changes to the base file will be overwritten every time you run the generator. If you want to make changes to the class you can do that in the subclasses, which are only created on the first run and will not be touched on subsequent generator runs.

> Note: There are currently some bugs in the Database part of the generator which results 
> in wrong migrations being creatated. This mainly affects MySQL and MariaDB, 
> PostgreSQL should be working fine.
> 
> If you run into these you need to adjust the generated migrations manually. Some migrations should be deleted if they contain only wrong changes.
> See <https://github.com/cebe/yii2-openapi/issues>, specifically <https://github.com/cebe/yii2-openapi/issues/100> and <https://github.com/cebe/yii2-openapi/issues/111>





