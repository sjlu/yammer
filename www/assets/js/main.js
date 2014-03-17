/**
 * RequireJS configuration of external modules.
 * and the root URL of our application MVC directory.
 */
requirejs.config({
  baseUrl: '/assets/js',
  paths: {
    'backbone': '../../bower_components/backbone/backbone',
    'hbs': '../../bower_components/require-handlebars-plugin/hbs',
    'jquery': '../../bower_components/jquery/dist/jquery',
    'underscore': '../../bower_components/lodash/dist/lodash.underscore'
  }
});