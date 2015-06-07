'use strict';

module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		project: {
			app: 'app',
			assets: '<%= project.app %>/assets',
			src: '<%= project.assets %>/src',
			css: [
			'<%= project.src %>/scss/style.scss'
			],
			js: [
			'<%= project.src %>/js/*.js'
			]
		},
		sass: {
		  dist: {
		    options: {
		      style: 'expanded',
		    },
		    files: {
		      'app/www/css/style.css': 'app/sass/*.scss'
		    }
		  }
		},
		watch: {
		  sass: {
		    files: 'app/sass/*.scss',
		    tasks: ['sass']
		  }
		}
	});

	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.registerTask('default', ['sass']);
};

