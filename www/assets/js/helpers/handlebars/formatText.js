define([
  'hbs/handlebars'
], function(
  Handlebars
) {

  Handlebars.registerHelper('formatText', function(text) {
    text = text.replace(/(https?:\/\/[^\s]+)/g, "<a href='$1'>$1</a>");
    return text;
  });

});