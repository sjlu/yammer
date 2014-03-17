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
    'underscore': '../../bower_components/lodash/dist/lodash.underscore',
    'md5': '../../bower_components/blueimp-md5/js/md5',
    'moment': '../../bower_components/moment/moment'
  },
  shim: {
    'backbone': {
      deps: ['jquery', 'underscore']
    }
  },
  hbs: {
    helperPathCallback: function(name) {
      return 'helpers/handlebars/' + name;
    }
  }
});