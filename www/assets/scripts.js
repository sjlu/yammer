define([
  'backbone'
], function(
  Backbone
) {

  var PostsCollection = Backbone.Collection.extend({

  });

  return PostsCollection;

});;/**
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
});;define([
  'backbone'
], function(
  Backbone
) {

  var PostModel = Backbone.Model.extend({
    "url": "/index.php/api/posts"
  });

  return PostModel;

});;define([
  'backbone'
], function(
  Backbone
) {

  var UserModel = Backbone.Model.extend({

  });

  return UserModel;

});;define([
  'backbone',
  'jquery',
  'views/welcome/layout'
], function(
  Backbone,
  $,
  WelcomeLayoutView
) {

  var WelcomeRouter = Backbone.Router.extend({

    routes: {
      '': 'home'
    },

    initialize: function() {
      // We are just passing the view over
      // for it to completely control the body.
      this.welcomeView = new WelcomeLayoutView({
        el: $('.container')
      });
    },

    home: function() {
      this.welcomeView.render();
    }

  });

  return WelcomeRouter;

});

;define([
  'backbone',
  'models/post',
  'hbs!templates/welcome/layout'
], function(
  Backbone,
  PostModel,
  welcomeLayoutTemplate
) {

  var WelcomeLayoutView = Backbone.View.extend({
    welcomeLayoutTemplate: welcomeLayoutTemplate,

    events: {
      'keypress textarea': 'typingHandler'
    },

    initialize: function() {

    },

    render: function() {
      // render the template onto the page.
      this.$el.html(this.welcomeLayoutTemplate());
    },

    typingHandler: function(e) {
      if (e.keyCode == 13 && e.shiftKey) {
        // get val and reset.
        var val = this.$('textarea').val();
        this.$('textarea').val('');

        var postModel = new PostModel();
        postModel.set('text', val);
        postModel.save();

        e.preventDefault();
      }
    }

  });

  return WelcomeLayoutView;

});;/**
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



