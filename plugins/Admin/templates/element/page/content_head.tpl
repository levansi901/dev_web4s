<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                {if !empty($title_for_layout)}{$title_for_layout}{/if}
            </h3>            
        </div>

        <div class="kt-subheader__toolbar">
            <a href="{$url_list}" class="btn btn-default btn-bold">
                {__d('admin', 'quay_lai')}
            </a>
            <div class="btn-group">
                <button id="btn-save" type="button" class="btn btn-brand btn-bold btn-save">
                    <i class="fa fa-plus"></i>
                    {__d('admin', 'them_moi')}
                </button>
                
                <button type="button" class="btn btn-brand btn-bold dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
                <div class="dropdown-menu dropdown-menu-right">
                    <ul class="kt-nav">
                        <li class="kt-nav__item">
                            <span data-link="{$url_edit}" data-update="1" class="kt-nav__link btn-save">
                                <i class="kt-nav__link-icon flaticon2-writing"></i>
                                <span class="kt-nav__link-text">
                                    {__d('admin', 'luu_&_tiep_tuc')}
                                </span>
                            </span>
                        </li>

                        <li class="kt-nav__item btn-save">
                            <span data-link="{$url_add}" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-medical-records"></i>
                                <span class="kt-nav__link-text">
                                    {__d('admin', 'luu_&_them_moi')}
                                </span>
                            </span>
                        </li>

                        <li class="kt-nav__item btn-save">
                            <span data-link="{$url_list}" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-hourglass-1"></i>
                                <span class="kt-nav__link-text">
                                    {__d('admin', 'luu_&_quay_lai')}
                                </span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>