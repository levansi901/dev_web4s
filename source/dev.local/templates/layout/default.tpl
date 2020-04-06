<!DOCTYPE html>
<html>
<head>
    
    <title>
        {if !empty($title_for_layout)}
            {$title_for_layout}
        {else}
            Web4s 
        {/if}
    </title>
        
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

<body>
    <div >
        {$this->fetch('content')}   
    </div>
</body>
</html>
