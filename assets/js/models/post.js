define([
  'backbone'
], function(
  Backbone
) {

  var PostModel = Backbone.Model.extend({
    urlRoot: "/index.php/api/posts"
  });

  return PostModel;

});