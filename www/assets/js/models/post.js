define([
  'backbone'
], function(
  Backbone
) {

  var PostModel = Backbone.Model.extend({
    "url": "/index.php/api/posts"
  });

  return PostModel;

});