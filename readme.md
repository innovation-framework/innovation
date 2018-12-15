1. Source trees
    + app
        + controller
        + http
            + api
            + middleware
        + library
        + model
    + bootstrap
    + config
    + database
    + public
    + resources
    + vendor

    -------------
    Explainations
    -------------
    1.1 app dir
        + controller: will contain controller files
        + http
            + api: will handle requet object in api/controller
            + middleware: will handle filter class
        + library: contains core application, developers will not implement whatever at here
        + model: implement business logic and interacte with db
    1.2 bootstrap
        Will bootstrap application
    1.3 config
        + app.php: contains configs of app, example: paging, timeout
        + database.php: contains configs of database
    1.4 database
        Will data files if you config 1.3 > database.php with driver = file, set permission of this dir is read & write for web app
    1.5 public
        contains images, css, js files
    1.6 resources
        contains languages files and more
    1.7 vender
        contains package vendor