
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

<!-- 	<script>    
	    if (typeof _api_path == 'undefined') {
	        var _api_path = '/api';
	    }

	    var app = new Vue({
	        delimiters: ['[', ']'],
	        el: '#nh-app',
	        data: {
	            users: []
	        },
	        mounted: function() {
	            this.getUsers()
	        },
	        methods: {
	            getUsers: function() {
	                axios.get(_api_path + '/user/list')
	                .then(function (response) {                
	                    app.users = response.data;
	                    console.log(response);
	                })
	                .catch(function (error) {
	                    console.log(error);
	                });
	            },
	            createUser: function() {},
	            resetForm: function() {}
	        }
	    })
	</script> -->
</body>
</html>
