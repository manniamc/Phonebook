<?php 
//connect to MySQL  
$db=new mysqli('localhost','root',''); 
//if 'save' button was pressed 
//user wants to store phone number 
if(isset($_POST['save'])) 
{ 
    $name=trim($_POST['name']); 
    $phno=trim($_POST['phno']); 
     
    //if data supplied are not empty 
    if(!$name=='' || !$phno=='') 
    {  
        $db->select_db('phonebook'); 
        //ready to insert data 
        $db->query("insert into phno (name, phnum) values ('$name', '$phno')"); 
    } 
}
?> 