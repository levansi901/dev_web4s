{assign var = url_list value = "{ADMIN_PATH}/user"}
{assign var = url_add value = "{ADMIN_PATH}/user/add"}
{assign var = url_edit value = "{ADMIN_PATH}/user/update/"}

<!--begin:: Content Head -->
{$this->element('Admin.page/content_head', [
    'url_list' => $url_list,
    'url_add' => $url_add,
    'url_edit' => $url_edit
])}
<!-- end:: Content Head -->

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <form id="main-form" action="{ADMIN_PATH}/user/save" method="POST">

        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">                        
                        {__d('admin', 'thong_tin_tai_khoan')}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">
                        {__d('admin', 'ten_dang_nhap')}
                        <span class="kt-font-danger">*</span>
                    </label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user-shield"></i>
                                </span>
                            </div>
                            <input name="username" class="form-control" type="text" value="">                            
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">
                        Email
                        <span class="kt-font-danger">*</span>
                    </label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <input name="email"  type="text" class="form-control" value="">
                        </div>
                    </div>
                </div>     

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">
                        {__d('admin', 'mat_khau')}
                        <span class="kt-font-danger">*</span>
                    </label>
                    <div class="col-lg-9 col-xl-6">
                        <input name="password" id="password" type="password" class="form-control" value="">
                    </div>
                </div>

                <div class="form-group form-group-last row">
                    <label class="col-xl-3 col-lg-3 col-form-label">
                        {__d('admin', 'xac_nhan_mat_khau')}
                        <span class="kt-font-danger">*</span>
                    </label>
                    <div class="col-lg-9 col-xl-6">
                        <input name="verify_password" type="password" class="form-control" value="">
                    </div>
                </div>

                <div class="kt-separator kt-separator--border kt-separator--portlet-fit kt-separator--space-lg"></div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">
                        {__d('admin', 'nhom_quyen')}
                    </label>
                    <div class="col-lg-9 col-xl-6">
                        {$this->Form->select('role_id', $list_role, ['name'=>'role_id', 'empty' => "{__d('admin', 'lua_chon')} ...", 'default' => '','class' => 'form-control'])}                                              
                    </div>
                </div>            
            </div>
        </div>

        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">                  
                        {__d('admin', 'thong_tin_ca_nhan')}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">
                            <div class="kt-avatar__holder"></div>
                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                <i class="fa fa-pen"></i>
                                <input type="file" accept=".png, .jpg, .jpeg">
                            </label>
                            <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                <i class="fa fa-times"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">
                        {__d('admin', 'ho_va_ten')}
                        <span class="kt-font-danger">*</span>
                    </label>
                    <div class="col-lg-9 col-xl-6">
                        <input name="full_name" class="form-control" type="text" value="">
                    </div>
                </div>                                        

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">
                        {__d('admin', 'so_dien_thoai')}
                    </label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-phone"></i>
                                </span>
                            </div>
                            <input name="phone" type="text" class="form-control" value="">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">
                        {__d('admin', 'dia_chi')}
                    </label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-map"></i>
                                </span>
                            </div>
                            <input name="address" class="form-control" type="text" value="">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">
                        {__d('admin', 'ngay_sinh')}
                    </label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-birthday-cake"></i>
                                </span>
                            </div>
                            <input name="birthday" class="form-control date-keyup" type="text" value="" placeholder="dd/mm/yyyy">
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- end:: Content