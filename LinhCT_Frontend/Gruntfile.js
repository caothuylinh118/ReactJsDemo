'use strict';
const sass = require('node-sass')

module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      options: {
        implementation: sass,
        sourceMap: true
      },
      dist: {
        files: {
          'src/assets/css/index.css': 'src/assets/scss/index.scss'
        }
      }
    },
    watch: {
      scripts: {
        files: ['src/assets/scss/index.scss'],
        tasks: ['sass'],
      },
    }
  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-sass');
  grunt.registerTask('default', ['sass','watch']);

};
