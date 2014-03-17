define([
  'backbone',
  'hbs!templates/welcome/layout'
], function(
  Backbone,
  welcomeLayoutTemplate
) {

  var WelcomeLayoutView = Backbone.View.extend({
    welcomeLayoutTemplate: welcomeLayoutTemplate,

    initialize: function() {

    },

    render: function() {
      // render the template onto the page.
      this.$el.html(this.welcomeLayoutTemplate());
    }

  });

  return WelcomeLayoutView;

});