define([
  'hbs/handlebars',
  'md5'
], function(
  Handlebars,
  md5
) {

  Handlebars.registerHelper('gravatar', function(email, size) {
    return 'https://s.gravatar.com/avatar/' + md5(email) + '?s=' + size;
  });

});