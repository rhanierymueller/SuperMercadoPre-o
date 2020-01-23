<?php
    
$base = pathinfo($_SERVER['PHP_SELF']);
$base = $base['config'];
$self = pathinfo(__FILE__);
$self = $self['config'];

if ($self == $base)
    die('Este arquivo n�o pode ser acessado diretamente.');

    
if (!(version_compare(phpversion(), "5.0", ">=")))
   die("O sistema precisa de PHP vers�o 5.0 ou superior.");
    

$prefix = (PHP_SHLIB_SUFFIX == 'dll') ? 'php_' : '';  
if (!extension_loaded('mysql'))
{
    if (function_exists('dl'))
	{
         if (!dl($prefix . 'mysql.' . PHP_SHLIB_SUFFIX))
             die("N�o foi poss�vel carregar a extens�o MySQL.");
         
    }
}
if (!extension_loaded('mysqli'))
{
    if (function_exists('dl'))
	{
        if (!dl($prefix . 'mysqli.' . PHP_SHLIB_SUFFIX))
            die("N�o foi poss�vel carregar a extens�o MySQLi.");
    }
}
 
if (!(defined('BARRA')))
    define('BARRA', DIRECTORY_SEPARATOR);  
    
if(function_exists('ini_set'))
{
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', '1');
    ini_set('short_open_tag', '0');
    ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . BARRA);
}
    
@set_magic_quotes_runtime(FALSE);
    
    
$constantes = array("DB_SERVIDOR" => "localhost", "DB_USUARIO" => "root", "DB_SENHA" => "asxz123", "DB_NOME" => "carrinho",  "IMAGENS_PATH" => "img" . BARRA, "CSS_PATH" => "css" . BARRA, "CSS_ARQ" => "default.css", "JS_PATH" => "js" . BARRA, "JS_ARQ" => "default.js", "FUNCOES_PATH" => "libs" . BARRA, "FUNCOES_ARQ" => "funcoes.php", "CLASSES_PATH" => "libs" . BARRA, "CLASSES_ARQ" => "classes.php", "LOGS_PATH" => "logs"  . BARRA);
   
$nome_const = array_keys($constantes);
$valor_const = array_values($constantes);
 
for($i = 0; $i < count($nome_const); $i++)
{
    if (!(defined($nome_const[$i])))
        define($nome_const[$i], $valor_const[$i]);

}
    


$caminho = (FUNCOES_PATH == '') ? FUNCOES_ARQ : FUNCOES_PATH . FUNCOES_ARQ;
if (file_exists($caminho))
    require_once($caminho);
else
    die("N�o foi poss�vel encontrar o arquivo de fun��es.");

$caminho = (CLASSES_PATH == '') ? CLASSES_ARQ : CLASSES_PATH . CLASSES_ARQ;
if (file_exists($caminho))
    require_once($caminho);
else
    die("N�o foi poss�vel encontrar o arquivo de classes.");
  
?>