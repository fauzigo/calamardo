<?PHP
require_once ('squid.class.php');
$tal=new squidConf();

$sp = '<br><br>';
print_r($tal->getAclClass());
echo '<br><br>';
print_r($tal->getAclClass('RegExp'));

echo $sp;

print_r($tal->getRulesClass());

?>
