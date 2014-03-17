define([
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

