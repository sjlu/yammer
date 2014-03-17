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

});