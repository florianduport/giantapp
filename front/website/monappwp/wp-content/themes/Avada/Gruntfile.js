module.exports = function(grunt) {
	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON("package.json"),
		less: {
			development: {
				files: {
					'style.css': 'less/style.less',
					'shortcodes.css': 'less/shortcodes.less'
				}
			}
		},
		watch: {
			css: {
				files: ['**/*.less'],
				tasks: ['less:development']
			}
		},
	});

	grunt.loadNpmTasks("grunt-contrib-less");
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask('watchCSS', ['watch:css']);
	grunt.registerTask("default", ["less:development"]);
};