define([
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

});