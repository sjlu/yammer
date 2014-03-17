define([
  'backbone',
  'models/post'
], function(
  Backbone,
  PostModel
) {

  var PostsCollection = Backbone.Collection.extend({
    url: "/index.php/api/posts",
    model: PostModel
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
    urlRoot: "/index.php/api/posts"
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

        var postModel = new PostModel();
        postModel.set('text', val);
        postModel.save();

        this.postsCollection.add(postModel, {at: 0});

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



