
<!DOCTYPE html>
<html>
<head>
    
    <title>
	    {if !empty($title_for_layout)}
	    	{$title_for_layout}
	    {else}
	    	Web4s Admin page
	    {/if}
	</title>
        
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

    <script src="{ADMIN_PATH}/assest/js/vue.js"></script>
    <script src="{ADMIN_PATH}/assest/js/axios.min.js"></script>
<body>
	<div style="background: red;">
		Header
	</div>
	<div id="nh-app">
		{$this->fetch('content')}	
	</div>
    <div style="background: green;">
		footer
	</div>

	<script src="{ADMIN_PATH}/js/main.js"></script>
</body>
</html>
