/**
 * This is an application and is what
 * starts the application.
 */
define([
  'backbone',
  'routers/welcome'
], function(
  Backbone,
  WelcomeRouter
) {

  // Instantiate the app router
  new WelcomeRouter();

  // Let backbone know that we're ready
  // to handle routes.
  Backbone.history.start();

});



