define([
  'hbs/handlebars',
  'moment'
], function(
  Handlebars,
  moment
) {

  Handlebars.registerHelper('timeAgo', function(time) {
    return moment(time + "+0000").fromNow();
  });

});