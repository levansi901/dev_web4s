"use strict";

var nhUser = function () {

	var formEl;
	var validator;

	var initValidation = function() {
		validator = formEl.validate({
			// Validate only visible fields
			ignore: ":hidden",

			// Validation rules
			rules: {
				username: {
					required: true
				},
				full_name: {
					required: true
				},
				email: {
					required: true,
					email: true
				},
				password: {
				required: true,
					
				}
			},

			// Display error
			invalidHandler: function(event, validator) {
				
			},

			// Submit valid form
			submitHandler: function (form) {

			}
		});
	}

	var initSubmit = function() {
		var btn = $('.btn-save');
		// var btn_save = $('#btn-save');
		btn.on('click', function(e) {
			e.preventDefault();

			if (validator.form()) {
				// See: src\js\framework\base\app.js
				KTApp.progress(btn);

				var urlRedirect = $(this).data('link');
				nhMain.ajaxSubmitForm({
	            	url: formEl.attr('action'),
	            	data: new FormData(formEl[0]),
	            	urlRedirect: urlRedirect,
	            	isUpdate: $(this).data('is-update')
	            });
			}
		});
	}


	return {
		// public functions
		init: function() {
			formEl = $('#main-form');			
			initValidation();
			initSubmit();		
		}
	};
}();

$(document).ready(function() {
	nhUser.init();
});
