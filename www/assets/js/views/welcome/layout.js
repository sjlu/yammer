define([
  'backbone',
  'models/post',
  'collections/posts',
  'hbs!templates/welcome/layout',
  'hbs!templates/welcome/post'
], function(
  Backbone,
  PostModel,
  PostsCollection,
  welcomeLayoutTemplate,
  postTemplate
) {

  var WelcomeLayoutView = Backbone.View.extend({
    welcomeLayoutTemplate: welcomeLayoutTemplate,
    postTemplate: postTemplate,

    events: {
      'keypress textarea': 'typingHandler'
    },

    initialize: function() {
      // load the base before
      // we start loading the components
      this.render();

      // Loading collections
      this.postsCollection = new PostsCollection();

      // Binding collections
      this.listenTo(this.postsCollection, "sync", this.renderPosts);
      this.listenTo(this.postsCollection, "change", this.renderPosts);

      // Init
      this.postsCollection.fetch();
    },

    setTag: function(tag) {
      if (tag) {
        this.postsCollection.fetch({
          data: {
            'tag': tag
          }
        });

        this.$('textarea, .instructions-to-submit').hide();
      } else {
        this.postsCollection.fetch();
        this.$('textarea, .instructions-to-submit').show();
      }
    },

    render: function() {
      // render the template onto the page.
      this.$el.html(this.welcomeLayoutTemplate());
    },

    renderPosts: function() {
      this.$('.posts').empty();
      this.postsCollection.each(_.bind(this.renderOnePost, this));
    },

    renderOnePost: function(post) {
      this.$('.posts').append(this.postTemplate(post.toJSON()));
    },

    typingHandler: function(e) {
      if (e.keyCode == 13 && e.shiftKey) {
        // get val and reset.
        var val = this.$('textarea').val();
        this.$('textarea').val('');

        // replace new lines with line breaks
        val = val.replace(/\n/g, "<br />");

        var postModel = new PostModel();
        this.postsCollection.add(postModel, {at: 0});

        postModel.set('text', val);
        postModel.save();

        e.preventDefault();
      }
    }

  });

  return WelcomeLayoutView;

});