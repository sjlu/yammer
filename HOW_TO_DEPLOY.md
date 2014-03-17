## How To Deploy

These instructions are for you to properly setup and deploy this application on Heroku.

### Instructions

* First create a Heroku instance with a custom buildpack.

        heroku apps:create
        heroku config:set BUILDPACK_URL=https://github.com/CHH/heroku-buildpack-php.git

    You should then get a response with a URL. For example, `http://polar-basin-6883.herokuapp.com/`.
    Just keep this in mind, you'll need it for the other steps.

* Go to the [Google Developers Console](https://console.developers.google.com/project) and register
a new application.

* When the application is created, go to `APIs & auth -> Credentials` and create a new OAuth key.
You should select the application type as **Web application**. Add in the URL generated from Heroku
as the **Authorized Javascript Origins**. And place the same URL with the suffix `index.php/authenticate/callback`
as the **Authorized redirect URI**.

* Take the credentials generated and run the following Heroku configuration commands.

        heroku config:set google_client_id=""
        heroku config:set google_client_secret=""

* In the `APIs & auth -> Consent screen`, add your **Product name** and set your email address.

* Next, we need to set tne encryption key to the application. It should be unique and random.

        heroku config:set encryption_key=""

* Add a database to the stack.

        heroku addons:add heroku-postgresql:dev

* Promote the new database by finding the environment variable name, the promoting it.

        heroku config | grep HEROKU_POSTGRESQL
        heroku pg:promote HEROKU_POSTGRESQL

* Lastly, push the code to heroku.

        git push heroku master

