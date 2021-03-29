<!DOCTYPE html>
<html>
    <head>
        <title> Curology</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
    <style>
       *{
      margin: 0;
    }
body{
         background-image: url(engin-akyurt-RJ17oltAMLk-unsplash.jpg) ;
         -moz-background-size: cover;
         -webkit-background-size: cover;
         -o-background-size: cover;
         background-size: cover;
         height: 100%;

  /*parallax effect */
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
         }
      
    nav {
   overflow: hidden;;
   padding: 10px;
}
.links {
   font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
   font-weight: bold;
   float: left;
   color:beige;
   text-align: center;
   padding: 12px;
   text-decoration: none;
   font-size: 18px;
   line-height: 25px;
   border-radius: 4px;
}
nav .logo {
   font-size: 25px;
   font-weight: bold;
}
nav .links:hover {
   background-color: #5f263e9f;
}
nav .selected {
   color: #18042b;
}
.rightSection {
   float: left;
}
@media screen and (max-width: 870px) {
   nav .links {
      float: none;
      display: block;
      text-align: left;
   }
 }
   .rightSection {
      float: none;
   }
   @media  only screen and (min-device-width: 768px) 
{
    .form-container {
      padding: 5%;
      background: #ffffff;
      border: 9px solid #f2f2f2;            
      max-width: 520px;
      margin: auto;
    }

}

h1, p 
{
  text-align: center;
}

input, textarea , button
{
  width: 100%;
}    
textarea
{
  height: 200px;
}


    </style>
    </head>
<body>
   <header>
      <nav>
         <div class="rightSection">
         <a class="links" href="home.html">Home</a>
         <a class="links" href="aboutUs.html">About Us</a>
         <a class="links" href="product.html">Product</a>
		 <a class="links" href="why.html">Why Curology?</a>
         <a class="selected links" href="contactus.html">Contact Us</a>
         </div>
        
</header>
<div class="form-container">
   <h1>Contact Us</h1>
 
   <form  method="post" id="reused_form" >
       <label for="name">Your Name:</label>
       <input id="name" type="text" name="Name" required maxlength="50">
 
       <label for="email">Email Address:</label>
       <input id="email" type="email" name="Email" required maxlength="50">
 
       <label for="message">Message:</label>
       <textarea id="message" name="Message" rows="10" maxlength="6000" required></textarea>
 
 
 
 
       <button class="button-primary" type="submit" >Post</button>
   </form>
   <div  id="success_message" style="display:none">
       <h3>Submitted the form successfully!</h3>
       <p>
       We will get back to you soon.
       </p>
   </div>
   <div id="error_message"
         style="width:100%; height:100%; display:none; ">
             <h3>Error</h3>
             Sorry there was an error sending your form.
 
   </div>
 </div>
 <script>
   $(function()
   {
       function after_form_submitted(data)
       {
           if(data.result == 'success')
           {
               $('form#reused_form').hide();
               $('#success_message').show();
               $('#error_message').hide();
           }
           else
           {
               $('#error_message').append('<ul></ul>');
   
               jQuery.each(data.errors,function(key,val)
               {
                   $('#error_message ul').append('<li>'+key+':'+val+'</li>');
               });
               $('#success_message').hide();
               $('#error_message').show();
   
               //reverse the response on the button
               $('button[type="button"]', $form).each(function()
               {
                   $btn = $(this);
                   label = $btn.prop('orig_label');
                   if(label)
                   {
                       $btn.prop('type','submit' );
                       $btn.text(label);
                       $btn.prop('orig_label','');
                   }
               });
   
           }//else
       }
   
      $('#reused_form').submit(function(e)
         {
           e.preventDefault();
   
           $form = $(this);
           //show some response on the button
           $('button[type="submit"]', $form).each(function()
           {
               $btn = $(this);
               $btn.prop('type','button' );
               $btn.prop('orig_label',$btn.text());
               $btn.text('Sending ...');
           });
   
   
                       $.ajax({
                   type: "POST",
                   url: 'handler.php',
                   data: $form.serialize(),
                   success: after_form_submitted,
                   dataType: 'json'
               });
   
         });
   });
   </script>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
Tested working with PHP5.4 and above (including PHP 7 )

 */
require_once './vendor/autoload.php';

use FormGuide\Handlx\FormHandler;


$pp = new FormHandler();

$validator = $pp->getValidator();
$validator->fields(['Name','Email'])->areRequired()->maxLength(50);
$validator->field('Email')->isEmail();
$validator->field('Message')->maxLength(6000);




$pp->sendEmailTo('ra47864@ubt-uni.net'); 

echo $pp->process($_POST);
</body>
</html>