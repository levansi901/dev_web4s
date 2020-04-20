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
					required: true,
					minlength: 6,
					maxlength: 255,
				},
				full_name: {
					required: true,
					minlength: 6,
					maxlength: 255
				},
				email: {
					required: true,
					email: true,
					minlength: 10,
					maxlength: 255
				},
				password: {
					minlength: 6,
					required: true,				
				},
				verify_password: {
                    equalTo: '#password'
                }
			},
			messages: {
				username: {
                    required: locales.vui_long_nhap_thong_tin,
                    minlength: locales.thong_tin_nhap_qua_ngan,
                    maxlength: locales.thong_tin_nhap_qua_dai
                },

                full_name: {
                    required: locales.vui_long_nhap_thong_tin,
                    minlength: locales.thong_tin_nhap_qua_ngan,
                    maxlength: locales.thong_tin_nhap_qua_dai
                },
                
                email: {
                	required: locales.vui_long_nhap_thong_tin,
                	email: locales.email_chua_dung_dinh_dang,
                	minlength: locales.thong_tin_nhap_qua_ngan,
                    maxlength: locales.thong_tin_nhap_qua_dai
                },

                password: {
                    required: locales.vui_long_nhap_thong_tin,
                    minlength: locales.thong_tin_nhap_qua_ngan
                },

                verify_password: {
                    equalTo: locales.xac_nhan_mat_khau_chua_chinh_xac
                }
            },

            errorPlacement: function(error, element) {
                var group = element.closest('.input-group');
                if (group.length) {
                    group.after(error.addClass('invalid-feedback'));
                }else{                	
                    element.after(error.addClass('invalid-feedback'));
                }
            },

			// Display error
			invalidHandler: function(event, validator) {
				KTUtil.scrollTop();
			},

			// Submit valid form
			submitHandler: function (form) {

			}
		});
	}

	var initSubmit = function() {
		var btn = $('.btn-save');
		btn.on('click', function(e) {
			e.preventDefault();

			if (validator.form()) {

				// show loading
				KTApp.progress(btn);
				KTApp.blockPage(blockOptions);
				
				// params call ajax
				var isUpdate = KTUtil.hasAttr(this, 'data-update') ? $(this).data('update') : 0;
				var urlRedirect = KTUtil.hasAttr(this, 'data-link') ? $(this).data('link') : '';

				nhMain.callAjax({
					url: formEl.attr('action'),
					data: new FormData(formEl[0]),
					processData: false,
					contentType: false
				}).done(function(response) {

					// hide loading
					KTApp.unprogress(btn);
					KTApp.unblockPage();

					//show message and redirect page
				   	var code = typeof(response.code) != _UNDEFINED ? response.code : _ERROR;
		        	var message = typeof(response.message) != _UNDEFINED ? response.message : '';
		        	var data = typeof(response.data) != _UNDEFINED ? response.data : {};

		        	toastr.clear();

		            if (code == _SUCCESS) {
		            	if(typeof(data.id) != _UNDEFINED && isUpdate == 1 && urlRedirect.length > 0){
		            		urlRedirect = urlRedirect + data.id
		            	}

		            	if(typeof(data.id) == _UNDEFINED && afterSave == 1 && urlRedirect.length > 0){
		            		urlRedirect = '';
		            	}

		            	toastr.info(message);

		            	if(urlRedirect.length > 0){
		            		window.location.href = urlRedirect;
		            	}else{
		            		location.reload();
		            	}
		            } else {
		            	toastr.error(message);
		            }
				});
			}
		});

		$(document).on('keyup', '.date-keyup', function(e){
		    nhMain.utilities.dateOnkeyup(this, e);
		});
	}

	return {
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
