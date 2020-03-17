<?php
use Cake\Core\Configure;

Configure::write('LIST_STATUS',
	[
		ENABLE => 'Hoạt động',
		DISABLE => 'Không hoạt động'
	]
);

Configure::write('LIST_STATUS_PRODUCT',
	[
		ENABLE => 'Hoạt động',
		DISABLE => 'Không hoạt động',
		STOP_BUSSINEUS => 'Ngừng kinh doanh'
	]
);