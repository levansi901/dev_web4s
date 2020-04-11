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
				// KTUtil.scrollTop();
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
				//KTApp.block(formEl);

				// See: http://malsup.com/jquery/form/#ajaxSubmit
				var urlRedirect = $(this).data('link');
				ss_page.ajaxSubmitForm({
	            	url: formEl.attr('action'),
	            	data: new FormData(formEl),
	            	url_redirect: urlRedirect,
	            	after_save: after_save
	            });

				ss_page.ajaxSubmitForm();
				formEl.ajaxSubmit({
					success: function() {
						KTApp.unprogress(btn);
						//KTApp.unblock(formEl);

						swal.fire({
							"title": "",
							"text": "The application has been successfully submitted!",
							"type": "success",
							"confirmButtonClass": "btn btn-secondary"
						});
					}
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