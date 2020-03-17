<?php
/* Smarty version 3.1.34-dev-7, created on 2020-02-24 03:21:28
  from 'D:\Work\Project\web4s\plugins\Admin\templates\layout\default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e5341383913f9_88588805',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '76be2e87506ece92409b8692268da020145023e2' => 
    array (
      0 => 'D:\\Work\\Project\\web4s\\plugins\\Admin\\templates\\layout\\default.tpl',
      1 => 1582514453,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e5341383913f9_88588805 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '7516313295e53413837f936_61024721';
?>

<!DOCTYPE html>
<html>
<head>
    
    <title><?php if (!empty($_smarty_tpl->tpl_vars['title_for_layout']->value)) {
echo $_smarty_tpl->tpl_vars['title_for_layout']->value;
} else { ?>Web4s Admin page<?php }?></title>
        
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
<body>
    <?php echo $_smarty_tpl->tpl_vars['this']->value->fetch('content');?>

</body>
</html>
<?php }
}
