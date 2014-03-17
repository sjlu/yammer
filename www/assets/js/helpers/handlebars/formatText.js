define([
  'hbs/handlebars'
], function(
  Handlebars
) {

  Handlebars.registerHelper('formatText', function(text) {
    // find links
    text = text.replace(/(https?:\/\/[^\s]+)/g, "<a href='$1' target='_blank'>$1</a>");

    // find hashtags
    text = text.replace(/#(\w+)/g, "<a href='/#$1'>#$1</a>");

    return text;
  });

});