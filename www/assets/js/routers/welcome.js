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
      '': 'home',
      '(:tag)': 'tag'
    },

    initialize: function() {
      // We are just passing the view over
      // for it to completely control the body.
      this.welcomeLayoutView = new WelcomeLayoutView({
        el: $('.container')
      });

      // Render the view to the page.
      this.welcomeLayoutView.render();
    },

    home: function() {
      this.welcomeLayoutView.setTag();
    },

    tag: function(tag) {
      this.welcomeLayoutView.setTag(tag);
    }

  });

  return WelcomeRouter;

});

