module.exports = function (grunt) {
  grunt.initConfig({

    files: {
      js: [
        'assets/vendor/twitter-bootstrap/dist/js/bootstrap.js',
        'assets/js/**/*.js'
      ],
      less: ['assets/less/**/*.less']
    },

    /**
     * LESS compilation
     * If you are creating any new files they
     * should all be referenced in base.less
     * and not here as this is only a compiler.
     */
    less: {
      options: {
        paths: [
          'assets/less'
        ]
      },
      default: {
        files: {
          "assets/styles.css": "assets/less/base.less"
        }
      }
    },

    /**
     * Watch
     * Watch the filesystem and auto-run these commands
     */
    watch: {
      options: {
        livereload: false,
        debounceDelay: 100,
        spawn: false
      },
      less: {
        files: '<%= files.less %>',
        tasks: ['less']
      }
    }

  });

  /**
   * Plugins
   * We load the necessary Grunt plugins that
   * help us run our compilation. You will also
   * need to reference this in package.json
   */
  require("matchdep").filterDev([
    "grunt-*",
    "!grunt-template-jasmine-requirejs"
  ]).forEach(grunt.loadNpmTasks);
 
  /*
   * Tasks
   */
  grunt.registerTask('default', ['less', 'watch']);
};
