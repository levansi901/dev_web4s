String.prototype.replaceAll = function (search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

var _SUCCESS = 'success';
var _ERROR = 'error';
var _MESSAGE = 'message';
var _DATA = 'data';
var _LANG = 'lang';
var _UNDEFINED = 'undefined';

var blockOptions = {
    overlayColor: '#000000',
    type: 'v2',
    state: 'success',
    message: locales.vui_long_cho + '...'
}


var nhMain = {
	csrfToken: null,
	cdnUrl: null,
	init: function(){
		var self = this;
		self.csrfToken = $('#csrf_token').val();
    	self.cdnUrl = $('#cdn_url').val();

    	// self.activeMenu();

    	$(document).on('focus', '.auto-numeric, .phone-input', function(e) {
    		$(this).select();
    	});    
	},
	ajaxSubmitForm: function(params = {}, callback){

		if (typeof(callback) != 'function') {
	        callback = function () {};
	    }

		var self = this;
	    var url = typeof(params.url) != _UNDEFINED ? params.url : '';	    
	    var type = typeof(params.type) != _UNDEFINED ? params.type : 'POST';
	    var dataType = typeof(params.dataType) != _UNDEFINED ? params.dataType : 'json';
	    var data = typeof(params.data) != _UNDEFINED ? params.data : {};
	    var async = typeof(params.async) != _UNDEFINED ? params.async : true;
	    var cache = typeof(params.cache) != _UNDEFINED ? params.cache : false;
	    var processData = typeof(params.processData) != _UNDEFINED ? params.processData : true;
	    var contentType = typeof(params.contentType) != _UNDEFINED ? params.contentType : true;
	    if(url.length == 0){
	    	self.notification({
            	type: 'error',
            	title: 'Đường dẫn thực thi không hợp lệ'
            });
            return false;
	    }
		$.ajax({
			headers: {
		        'X-CSRF-Token': self.csrfToken
		    },
	        async: async,
	        url: url,
	        type: type,
	        dataType: dataType,
	        data: data,	        
	        cache: cache,
	        processData: processData,
	        contentType: contentType,
	    }).done(function(response) {
	    	callback(response);
		}).fail(function(jqXHR, textStatus, errorThrown) {
			toastr.error(textStatus + ': ' + errorThrown);
		});
	},
	callAjax: function(params = {}){
		var self = this;
		
		var ajax = $.ajax({
			headers: {
		        'X-CSRF-Token': self.csrfToken
		    },
	        async: typeof(params.async) != _UNDEFINED ? params.async : true,
	        url: typeof(params.url) != _UNDEFINED ? params.url : '',
	        type: typeof(params.type) != _UNDEFINED ? params.type : 'POST',
	        dataType: typeof(params.dataType) != _UNDEFINED ? params.dataType : 'json',
	        data: typeof(params.data) != _UNDEFINED ? params.data : {},    
	        cache: typeof(params.cache) != _UNDEFINED ? params.cache : false,
	        processData : typeof(params.processData) != _UNDEFINED ? params.processData : false,
	    	contentType : typeof(params.contentType) != _UNDEFINED ? params.contentType : false
	    }).fail(function(jqXHR, textStatus, errorThrown){
	    	if(typeof(params.not_show_error) == _UNDEFINED){
	    		toastr.error(textStatus + ': ' + errorThrown);
	    	}			
		});
	    return ajax;
	},	
	activeMenu: function(){
		var href = window.location.href.split(document.domain);
        var url = href[1];
        var urlReference = $('body').attr('url-reference');
        if ($('#left-sidebar a[href="' + url + '"]').length > 0) {
	        a_active = $('#left-sidebar a[href="' + url + '"]');
	    } else if (typeof(urlReference) != _UNDEFINED && $('#left-sidebar a[href="' + urlReference + '"]').length > 0) {
	        a_active = $('#left-sidebar a[href="' + urlReference + '"]');
	    }
	    
	    if(typeof(a_active) != _UNDEFINED){
	    	a_active.addClass('active-page');	
	    	// active menu
		    var ul_collasible_body = a_active.closest('.collapsible-body');
		    ul_collasible_body.show();
		    ul_collasible_body.closest('li').addClass('active');
		    ul_collasible_body.closest('li').find('> a').addClass('active');
	    }	   	   
	},
	alertWarning: function(params = {}, callback){
		if (typeof(callback) != 'function') {
	        callback = function () {};
	    }

		var type = typeof(params.type) != _UNDEFINED ? params.type : 'warning';
		var title = typeof(params.title) != _UNDEFINED ? params.title : '';
		var text = typeof(params.text) != _UNDEFINED ? params.text : '';		
		var reason_validation = typeof(params.reason_validation) != _UNDEFINED ? params.reason_validation : 'Vui lòng nhập lý do xóa';

		swal({   
		    title: title,   
		    text: text,   
		    type: type,   
		    confirmButtonText: 'Đồng ý', 
		    cancelButtonText: 'Hủy bỏ',
		    showCancelButton: true,   
		    closeOnConfirm: true,
		}, function(response){  

			if(type == 'input'){
				if (response === false) return false;              
			    if (response === '') {     
			        swal.showInputError(reason_validation);     
			        return false;
			    }   
			}

			if (response && type == 'warning') {
		        callback();
		    }

		});
	},
	shortcut: function(){
		$(document).on('keydown', function (e) {
		    var shortcut = e.keyCode;
		    var disabled = $('[shortcut="' + shortcut + '"]').attr('disabled');
		    if ($('[shortcut="' + shortcut + '"]').length > 0 && typeof disabled == "undefined") {
		        if ($('[shortcut="' + shortcut + '"]').is('[type=text]')) {
		            $('[shortcut="' + shortcut + '"]').focus();
		        } else {
		            $('[shortcut="' + shortcut + '"]').trigger('click');
		        }
		        e.preventDefault();
		    }
		});
	},
	tinyMce: function(params = {}){
		var self = this;
		tinymce.init({
		  	selector: '.mce-editor',
		  	height: 400,
		  	menubar: false,
		  	plugins: [
		    	'advlist autolink lists link image charmap print preview textcolor',
		    	'searchreplace visualblocks code fullscreen',
		    	'media table contextmenu paste code help wordcount responsivefilemanager'
		  	],
		  	image_advtab: true ,
		  	toolbar: 'formatselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link responsivefilemanager image | code | fullscreen',
		  	filemanager_crossdomain: true,
		  	external_filemanager_path: self.cdnUrl + '/filemanager/',
   			filemanager_title: 'CDN S-Sale',
   			external_plugins: { 'filemanager' : self.cdnUrl + '/filemanager/plugin.min.js'},
   			filemanager_access_key: typeof(params.filemanager_access_key) != _UNDEFINED ? params.filemanager_access_key : null
		});
	},
	autoCompleteBasic: function(params = {}, callback){
		if (typeof(callback) != 'function') {
	        callback = function () {};
	    }

	    var input_suggest = typeof(params.input_suggest) != _UNDEFINED ? params.input_suggest : '';
	    var input_value_id = typeof(params.input_value_id) != _UNDEFINED ? params.input_value_id : '';
	    var url = typeof(params.url) != _UNDEFINED ? params.url : '';
	    var label_field = typeof(params.label_field) != _UNDEFINED ? params.label_field : '';
	    var query = typeof(params.query) != _UNDEFINED ? params.query : {};

	    if(input_suggest.length > 0 && url.length > 0){

	    	$(document).on('focus', input_suggest, function(e) {
				$(this).select();
			});				    

			$(input_suggest).autoComplete({
				minChars: 0,
			    source: function(keyword, suggest){
			    	var data = $.extend({}, {keyword: keyword}, query);
			    	nhMain.callAjax({
						url: url,
						data: data
					}).done(function(response) {
					    suggest(response);
					});
			    },
			    renderItem: function (item, search){
			        search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
			        var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
			        var id = typeof(item.id) != _UNDEFINED ? item.id : '';
			        var name = typeof(item.name) != _UNDEFINED ? item.name : '';
			        
			        if(label_field.length > 0 && label_field != 'name'){
			        	name = typeof(item[label_field]) != _UNDEFINED ? item[label_field] : '';
			        }
			        
			        return '<div class="autocomplete-suggestion single-suggestion" data-name="' +  name + '" data-id="' + id + '">' + name.replace(re, "<b>$1</b>") + '</div>';
			    },
			    onSelect: function(e, term, item){
			    	$(input_suggest).val(item.data('name'));
			    	if(typeof(input_value_id) != _UNDEFINED && input_value_id.length > 0){
			    		$(input_value_id).val(item.data('id'));
			    	}
			    }
			});

			if(typeof(input_value_id) != _UNDEFINED && input_value_id.length > 0){
				$(document).on('change', input_suggest, function(e) {								
					$(input_value_id).val('');	    		
				});
			}
	    }	   
	},
	validation: {
		isEmail: function(email = null){
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  		return regex.test(email);
		},
		isPhone: function(phone = null){
			var regex = /[0-9]{10,11}/;
	  		return regex.test(phone);
		},
		phoneInput: function(){
			$(document).on('keypress', '.phone-input', function(e) {			
				if(!$.isNumeric(e.key)){
					return false;
				}

				if($(this).val().length > 10){
					return false;
				}
			});
		},
		showError: function(params = {}, callback){
			var input = typeof(params.input_object) != _UNDEFINED ? params.input_object : null;
			var error_message = typeof(params.error_message) != _UNDEFINED ? params.error_message : null;	

			if(input.length > 0 && error_message.length > 0){
				input.next('label.error').remove();
				if (typeof(callback) != 'function') {
			        callback = function () {};
			    }
				var id = typeof(input.attr('id')) != _UNDEFINED ? input.attr('id') + '-error' : '';
				var error = '<label id="' + id + '" class="error" for="' + id + '">' + error_message + '</label>';
				input.after(error).focus();
				callback();
			}		
		},
		clearError: function(wrap_object = null){
			if(wrap_object.length > 0){
				wrap_object.find('label.error').remove();
			}
		}
	},
	utilities: {
		parseNumberToTextMoney: function(number = null){
			if (typeof(number) != 'number' || isNaN(number) || typeof(number) == _UNDEFINED) {
		        return 0;
		    }	    
	    	return number.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
		},
		parseTextMoneyToNumber: function(text_number = null){
			if (typeof(text_number) == _UNDEFINED) {
		        return 0;
		    }

			var number = parseFloat(text_number.toString().replace(/,/g, ''));
			return number;
		},
		parseFloat: function(number = null){
			if (isNaN(number) || typeof(number) == _UNDEFINED || number == null) {
		        return 0;
		    }	

			number = parseFloat(number);
			if (isNaN(number)) {
		        return 0;
		    }
		    return number;
		},
		parseInt: function(number = null){
			if (isNaN(number) || typeof(number) == _UNDEFINED || number == null) {
		        return 0;
		    }	

			number = parseInt(number);
			if (isNaN(number)) {
		        return 0;
		    }
		    return number;
		},
		dateOnkeyup: function(d, e){
			var pK = (e.which) ? e.which : window.event.keyCode;
		    if (pK == 8) {
		        return;
		    }
		    var dt = d.value;
		    var da = dt.split('/');
		    for (var a = 0; a < da.length; a++) {
		        if (da[a] != +da[a]) da[a] = da[a].substr(0, da[a].length - 1);
		    }
		    if (da[0] > 31) {
		        da[1] = da[0].substr(da[0].length - 1, 1);
		        da[0] = '0' + da[0].substr(0, da[0].length - 1);
		    }
		    if (da[1] > 12) {
		        da[2] = da[1].substr(da[1].length - 1, 1);
		        da[1] = '0' + da[1].substr(0, da[1].length - 1);
		    }
		    if (da[2] > 9999) da[2] = da[2].substr(0, da[2].length - 1);
		    if (da[0] > 28 & da[1] == 02 & da[2] > 999) {
		        if ((da[2] % 4) == 0 & (da[2] % 100) == 0) {
		            da[0] = 29;
		        }
		        else {
		            da[0] = 28;
		        }
		    }
		    if (da[0] > 30 & (da[1] == 04 || da[1] == 06 || da[1] == 09 || da[1] == 11 )) {
		        da[0] = 30;
		    }
		    dt = da.join('/');
		    if (dt.length == 2 || dt.length == 5) dt += '/';
		    d.value = dt.replace('//', '/');
		},
	},
	location: {
		city_district_select:{
			select: '.city-district',
			event: function(){
				var self = this;

				$(document).on('change', self.select, function(e) {
		    		var wrap = $(this).closest('.input-field');
		    		var city_id = typeof($(this).find(":selected").data('city-id')) ? $(this).find(":selected").data('city-id') : '';
		    		var city_name = typeof($(this).find(":selected").data('city-name')) ? $(this).find(":selected").data('city-name') : '';
		    		var district_id = typeof($(this).find(":selected").data('district-id')) ? $(this).find(":selected").data('district-id') : '';
		    		var district_name = typeof($(this).find(":selected").data('district-name')) ? $(this).find(":selected").data('district-name') : '';

		    		wrap.find('input.city').val(city_id);
		    		wrap.find('input.city-name').val(city_name);
		    		wrap.find('input.district').val(district_id);
		    		wrap.find('input.district-name').val(district_name);
		    	}); 
			}
		}		
	}
}

var nhList = {
	wrap_list: '#wrap-list',
	wrap_filter: '#wrap-filter',
	wrap_more_filter: '#wrap-more-filter',
	form: '#form-list-data',
	table: '#data-table',
	init: function(){
		var self = this;		

		//pagination click
		$(self.form).on('click', '.pagination > li[data-page]:not(.active)', function() {
			var page = typeof($(this).data('page')) != _UNDEFINED ? parseInt($(this).data('page')) : null;
			if(page == null) return false;
			$(self.form).find('input[name="page"]').val(page);	
			self.loadListData(function(){
				$('html, body').animate({
			        scrollTop: $(self.wrap_list).offset().top - 5
			    }, 400);
			});
		});

		//limit change
		$(self.form).on('change', 'select#limit', function() {
			var limit = typeof($(this).val()) != _UNDEFINED ? parseInt($(this).val()) : null;
			if(limit == null) return false;
			$(self.form + ' input[name="limit"]').val(limit);
			self.loadListData();
		});

		//search
		$(self.form).on('click', '#filter-data', function() {
			self.loadListData();
		});

		//reset input search
		$(self.form).on('click', '#reset-filter', function() {
			$(self.form).find('input[name="page"]').val(1);
			$(self.wrap_filter).find('input').val('');
			$(self.wrap_filter).find('select').val('').trigger('change');
			self.loadListData();
		});

		//more filter
		$(self.form).on('click', '#more-filter', function() {
			self.toggleMoreFilter();
		});

		//sort data table
		$(self.form).on('click', 'th.sorting:not(.hide-text), th.sorting_asc:not(.hide-text), th.sorting_desc:not(.hide-text)', function() {
			var sort = $(this).data('sort');
			var direction = '';
			if(sort == _UNDEFINED){
				return false;
			}

			var type_sort = '';
			if($(this).hasClass('sorting')){
				type_sort = 'sorting';		
			}

			if($(this).hasClass('sorting_asc')){
				type_sort = 'asc';
			}

			if($(this).hasClass('sorting_desc')){
				type_sort = 'desc';
			}

			$(self.table).find('th[data-sort]').removeClass('sorting_asc sorting_desc').addClass('sorting');
			switch(type_sort){
				case 'sorting':
				case 'desc':
					$(this).removeClass('sorting').addClass('sorting_asc');
					direction = 'asc';
					break;
				case 'asc':
					$(this).removeClass('sorting').addClass('sorting_desc');
					direction = 'desc';
					break;
			}

			$(self.form).find('input[name="sort"]').val(sort);
			$(self.form).find('input[name="direction"]').val(direction);

			self.loadListData();
		});

		//check all
		$(self.form).on('change', '#select-all', function() {
			$(self.table).find('.select-record').prop('checked', $(this).is(":checked"));			
			self.toggleShowActionList($(this).is(":checked"));
		});

		//checkbox change
		$(self.form).on('change', 'input.select-record', function() {
			if($(this).is(":checked") && $(self.table + ' input.select-record:checked').length == 1){
				self.toggleShowActionList(true);
			}

			if(!$(this).is(":checked") && $(self.table + ' input.select-record:checked').length == 0){
				self.toggleShowActionList(false);
			}
		});		

	},
	loadListData: function(callback){

		if (typeof(callback) != 'function') {
	        callback = function () {};
	    }

		var self = this;

		var data = {};
	    var params = {};
	    $.map($(self.form).serializeArray(), function (n, i) {
	        data[n['name']] = $.trim(n['value']);
	        if($.trim(n['value']).length > 0){
	        	params[n['name']] = $.trim(n['value']);
	        }
	    });
	  
	    var url = typeof($(self.form).attr('action')) != _UNDEFINED ? $(self.form).attr('action') : '';
	    url += url.length > 0 ? '?' + $.param(params) : '';

		nhMain.callAjax({
			url: url,
			data_type: 'html',
			data: data
		}).done(function(response) {			

			$(self.wrap_list).html(response);
			$('select').material_select();
			$('.dropdown-button').dropdown();

			callback();
		});
	},
	toggleMoreFilter: function(){
		var self = this;
		var is_show = false;
		var icon = '';
		if(!$(self.wrap_more_filter).find('.collapsible-body').is(':hidden')){
			is_show = true;
		}

		if(is_show){
			icon = 'keyboard_arrow_down';
			$(self.wrap_more_filter).find('.collapsible-body').hide();
		}else{
			$(self.wrap_more_filter).find('.collapsible-body').show();
			icon = 'keyboard_arrow_up';
		}

		$(self.form).find('#more-filter i').text(icon);
		$(self.wrap_more_filter).toggleClass('active');
	},
	toggleShowActionList: function(show = true){
		var self = this;
		if(show){
			$(self.table).find('thead > tr > th:not(:first-child)').addClass('hide-text');
			$(self.table).find('thead > tr > th > #wrap-action-list').removeClass('hide');
		}else{
			$(self.table).find('thead > tr > th:not(:first-child)').removeClass('hide-text');
			$(self.table).find('thead > tr > th > #wrap-action-list').addClass('hide');
		}		
	}
}


$(document).ready(function() {
	nhMain.init();
});

// $(document).ajaxStart(function () {
//     preloader.on();
// });

// $(document).ajaxComplete(function () {
//     preloader.off();
// });

// $(document).ajaxError(function () {
//     preloader.off();
// });
