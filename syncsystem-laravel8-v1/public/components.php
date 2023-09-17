<?php 

echo "SERVER_ADDR (ip - servidor)= " . $_SERVER['SERVER_ADDR'] . "<br/>"; //pode ser que não funcione em todos os servidores
echo "LOCAL_ADDR (ip - servidor)= " . $_SERVER['LOCAL_ADDR'] . "<br/>";
echo "getenv SERVER_ADDR (ip - servidor)= " . getenv('SERVER_ADDR') . "<br/>"; //alternativa

echo "DOCUMENT_ROOT= " . $_SERVER['DOCUMENT_ROOT'] . "<br/>";
echo "dirname= " . dirname(__FILE__) . "<br/>";
echo "PATH_SEPARATOR= " . PATH_SEPARATOR . "<br/>";

echo phpinfo();


if (function_exists("array_combine"))
{
	echo "Function exists";
}
else
{
	echo "Function does not exist - better write our own";
}

?>