### Intro

I will explain a little bit in detail about the architecture here and what decisions were made.

### Structure

This application was built using a LAMP stack with CodeIgniter as the PHP framework. The backend
code is made there and can be located in the [application](application) directory.

The frontend part of this application was built using Backbone.js and Require.js. These files
can be found in the [assets/js](assets/js) directory.

Stylesheets are compiled ahead of time with Grunt. Those stylesheets can be found in the
[assets/less](assets/less) directory.

There are several components that this application depends on. They include Bower (for frontend
JS components), Grunt (for compiling LESS), and Composer (for grabbing the Google Auth library).

### Backend

The first part would to take a look at how I handle authentication. This can be found in
[application/libraries/Google_Auth.php]. It is decently documented, but essentially this file will
load our configuration file from [application/config/google.php](application/config/google.php) and
instantiate a Google Client class that we can use.

We then have `create_auth_url` function which creates an OAuth2 URL to redirect to and authenticate
with Google. When it comes back, we use `handle_code` to verify with Google that it is authentic.
`set_session` and `get_session` don't relate with Google, but they set the current active session
to our application. I use these functions primarily to set who the current user is and get their
email address.

Next is our authentication controller
[application/controllers/authenticate.php](application/controllers/authenticate.php).
It is essentially just calling the Google auth functions above to create an active session.

When a session is good and dandy, we can then redirect them to the Welcome controller
[application/controllers/welcome.php](application/controllers/welcome.php) which then just
loads a base template for our Frontend to initialize our Require.js application. That view
controller can be found at [application/views/pages/welcome.php](application/views/pages/welcome.php).

The data models can be found here: [application/models](application/models), they are very basic
in nature and just support create and and select functionality. There is a many-to-one relationship
from Posts to Users and a many-to-many relationship from Posts to Tags.

Those data models are supported by the database tables, which is defined in the migrations.
[application/migrations](application/migrations).

### Frontend

The frontend is located in [assets/js](assets/js) and essentially calls [assets/js/main.js](assets/js/main.js)
to bootstrap Require.js and [assets/js/welcome.js](assets/js/welcome.js) to initialize the single-page
application.

The main layout view is at [assets/js/views/welcome/layout.js](assets/js/views/welcome/layout.js) which
controls the page to its entirety. Here we have the submit handler, the posts handler which calls
out to it's counterparts in [assets/js/collections](assets/js/collections), [assets/js/models](assets/js/models),
and [assets/js/templates](assets/js/templates).

Links, posts, hashtags and time ago is handled by Handlebars helpers. Those can be found in
[assets/js/helpers](assets/js/helpers).