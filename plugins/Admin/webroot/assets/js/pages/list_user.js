"use strict";

var csrfToken = typeof($('#csrf_token').val()) != _UNDEFINED ? $('#csrf_token').val() : null;
var nhLoadListDatabase = function() {
	var options = {			
		data: {
			type: 'remote',
			source: {
				read: {
					url: adminPath + '/user/list/json',
					headers: {
						'X-CSRF-Token': csrfToken
					},
					map: function(raw) {
						var dataSet = raw;
						if (typeof raw.data !== _UNDEFINED) {
							dataSet = raw.data;
						}
						return dataSet;
					},
				},
			},
			pageSize: 10,
			serverPaging: true,
			serverFiltering: true,
			serverSorting: true,
		},
		
		layout: {
			scroll: false,
			footer: false,
		},

		sortable: true,

		pagination: true,
		extensions: {
			checkbox: true
		},
		search: {
			input: $('#nh-keyword'),
		},

		columns: [
			{
				field: 'id',
				title: '',
				sortable: 'asc',
				width: 30,
				type: 'number',
				selector: {class: 'kt-checkbox--solid'},
				textAlign: 'center',
			},
			{
				field: 'full_name',
				title: locales.ho_ten,
				autoHide: false,
			}, 
			{
				field: 'role_id',
				title: locales.phan_quyen,
				template: function(row) {
					var role = KTUtil.isset(row, 'role') ? row.role : {};
					return role ? role.name : '';
				}
			},
			{
				field: 'email',
				title: 'Email',				
			},
			{
				field: 'phone',
				title: locales.so_dien_thoai,
			},
			{
				field: 'status',
				title: locales.trang_thai,
				width: 110,
				template: function(row) {
					return '<span class="kt-badge ' + statusOptions[row.status].class + ' kt-badge--inline kt-badge--pill">' + statusOptions[row.status].title + '</span>';
				},
			},  
			{
				field: 'actions',
				title: '<i class="la la-cogs fs-20"></i>',
				sortable: false,
				width: 30,
				overflow: 'visible',
				autoHide: false,
				template: function(row) {
					return '\
						<div class="dropdown">\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
                                <i class="la la-ellipsis-h"></i>\
                            </a>\
						  	<div class="dropdown-menu dropdown-menu-right">\
						    	<a class="dropdown-item" href="' + adminPath + '/user/update/' + row.id + '"><i class="la la-edit w-20"></i>' + locales.sua_thong_tin + '</a>\
						    	<div class="dropdown-divider"></div>\
						    	<a class="dropdown-item nh-change-status" href="javascript:;"><i class="la la-check text-success w-20 fs-15"></i>' + locales.hoat_dong + '</a>\
						    	<a class="dropdown-item nh-change-status" href="javascript:;"><i class="la la-ban w-20 fs-15"></i>' + locales.ngung_hoat_dong + '</a>\
						    	<div class="dropdown-divider"></div>\
						    	<a class="dropdown-item nh-delete" href="javascript:;"><i class="la la-trash-o text-danger w-20 fs-15"></i>' + locales.xoa + '</a>\
						  	</div>\
						</div>\
					';
				},
			}]
	};
	
	var listData = function() {
		var datatable = $('.kt-datatable').KTDatatable(options);

	    $('#nh_status').on('change', function() {
	      	datatable.search($(this).val().toLowerCase(), 'status');
	    });

	    $('#nh_status').selectpicker();

	    datatable.on('kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated', function(e) {
            var ids = datatable.checkbox().getSelectedId();
            var ids = ids.filter(function(itm, i, a) {
			    return i == a.indexOf(itm);
			});
            var count = ids.length;
            $('#nh-selected-number').html(count);
            if (count > 0) {
                $('#nh-group-action').collapse('show');
            } else {
                $('#nh-group-action').collapse('hide');
            }
        });
	};

	return {
		init: function() {
			listData();
		}
	};
}();

jQuery(document).ready(function() {
	nhLoadListDatabase.init();
});
