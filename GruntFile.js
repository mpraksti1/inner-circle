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
			dev: {
				options: {
					style: 'expanded',
					banner: '<%= tag.banner %>',
					compass: true
				},
				files: {
				    '<%= project.assets %>/css/style.css': '<%= project.css %>'
				}
			},
		  dist: {
		    options: {
		      style: 'compressed',
		      compass: true
		    },
		    files: {
		      '<%= project.assets %>/css/style.css': '<%= project.css %>'
		    }
		  }
		},
		watch: {
		  sass: {
		    files: '<%= project.src %>/scss/{,*/}*.{scss,sass}',
		    tasks: ['sass:dev']
		  }
		}
	});
};

