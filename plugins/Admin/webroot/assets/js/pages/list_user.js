"use strict";

var csrfToken = typeof($('#csrf_token').val()) != _UNDEFINED ? $('#csrf_token').val() : null;
var nhLoadListDatabase = function() {
	var options = {			
		data: {
			type: 'remote',
			source: {
				read: {
					url: '/admin/user/list/json',
					headers: {
						'X-CSRF-Token': csrfToken
					},
					map: function(raw) {
						var dataSet = raw;
						if (typeof raw.data !== 'undefined') {
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
			input: $('#nh-general-search'),
		},

		columns: [
			{
				field: 'RecordID',
				title: '',
				sortable: 'asc',
				width: 20,
				type: 'number',
				// selector: false,
				selector: {class: 'kt-checkbox--solid'},
				textAlign: 'center',
			}, 
			{
				field: 'OrderID',
				title: 'Order ID',
			}, 
			{
				field: 'Country',
				title: 'Country',
				template: function(row) {
					return row.Country + ' ' + row.ShipCountry;
				},
			}, 
			{
				field: 'ShipDate',
				title: 'Ship Date',
				type: 'date',
				format: 'MM/DD/YYYY',
			}, 
			{
				field: 'CompanyName',
				title: 'Company Name',
			}, 
			{
				field: 'Status',
				title: 'Status',
				template: function(row) {
					var status = {
						0: {'title': 'Danger', 'class': ' kt-badge--danger'},
						1: {'title': 'Success', 'class': ' kt-badge--success'}						
					};
					return '<span class="kt-badge ' + status[row.status].class + ' kt-badge--inline kt-badge--pill">' + status[row.status].title + '</span>';
				},
			},  
			{
				field: 'Actions',
				title: 'Actions',
				sortable: false,
				width: 110,
				overflow: 'visible',
				autoHide: false,
				template: function() {
					return '\
					<div class="dropdown">\
						<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" data-toggle="dropdown">\
                            <i class="flaticon2-gear"></i>\
                        </a>\
					  	<div class="dropdown-menu dropdown-menu-right">\
					    	<a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\
					    	<a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\
					    	<a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\
					  	</div>\
					</div>\
					<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
						<i class="flaticon2-paper"></i>\
					</a>\
					<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete">\
						<i class="flaticon2-trash"></i>\
					</a>\
				';
				},
			}],
	};
	
	var listData = function() {
		var datatable = $('.kt-datatable').KTDatatable(options);

	    $('#kt_form_status').on('change', function() {
	      datatable.search($(this).val().toLowerCase(), 'Status');
	    });

	    $('#kt_form_type').on('change', function() {
	      datatable.search($(this).val().toLowerCase(), 'Type');
	    });

	    $('#kt_form_status, #kt_form_type').selectpicker();

	    datatable.on('kt-datatable--on-click-checkbox kt-datatable--on-layout-updated', function(e) {
            var ids = datatable.checkbox().getSelectedId();
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
