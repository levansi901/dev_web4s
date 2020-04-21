<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {__d('admin', 'danh_sach_tai_khoan')}
            </h3>

            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Crud 
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    KTDatatable 
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Advanced 
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Column Rendering 
                </a>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <a href="{ADMIN_PATH}/user/add" class="btn btn-brand">
                <i class="fa fa-plus"></i>
                {__d('admin', 'them_tai_khoan')}
            </a>
        </div>
    </div>
</div>


<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">

        <div class="kt-portlet__body">

            <div class="kt-form">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input id="nh-general-search" type="text" class="form-control" placeholder="Search...">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Status:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control bootstrap-select" id="kt_form_status">
                                            <option value="">All</option>
                                            <option value="1">Pending</option>
                                            <option value="2">Delivered</option>
                                            <option value="3">Canceled</option>
                                            <option value="4">Success</option>
                                            <option value="5">Info</option>
                                            <option value="6">Danger</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Type:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control bootstrap-select" id="kt_form_type">
                                            <option value="">All</option>
                                            <option value="1">Online</option>
                                            <option value="2">Retail</option>
                                            <option value="3">Direct</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                        <a href="#" class="btn btn-default kt-hidden">
                            <i class="la la-cart-plus"></i> New Order
                        </a>
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                    </div>
                </div>
            </div>

            <div id="nh-group-action" class="kt-form kt-form--label-align-right kt-margin-t-20 collapse">
                <div class="row align-items-center">
                    <div class="col-xl-12">
                        <div class="kt-form__group kt-form__group--inline">
                            <div class="kt-form__label kt-form__label-no-wrap">
                                <label class="kt-font-bold kt-font-danger-">Selected
                                    <span id="nh-selected-number">0</span> records:</label>
                            </div>
                            <div class="kt-form__control">
                                <div class="btn-toolbar">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-brand btn-sm dropdown-toggle" data-toggle="dropdown">
                                            Update status
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Pending</a>
                                            <a class="dropdown-item" href="#">Delivered</a>
                                            <a class="dropdown-item" href="#">Canceled</a>
                                        </div>
                                    </div>
                                  
                                    <button class="btn btn-sm btn-danger" type="button" id="kt_datatable_delete_all1">Delete All</button>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-datatable" id="ajax_data"></div>
        </div>
    </div>
</div>
