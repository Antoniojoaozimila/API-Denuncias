<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contactos</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- bootstrap css -->
   <link rel="stylesheet" href="app/sts/assets/css/bootstrap.min.css">
   <!-- style css -->
   <link rel="stylesheet" href="app/sts/assets/css/style.css">
   <!-- responsive-->
   <link rel="stylesheet" href="app/sts/assets/css/responsive.css">
   <!-- awesome fontfamily -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
   <?php include "include/sideBar.php"; ?>
   <div class="contact">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage text_align_center">
                  <h2>Contact Us</h2>
               </div>
            </div>
            <div class=" col-md-10 offset-md-1">
               <form id="request" class="main_form">
                  <div class="row">
                     <div class="col-md-12 ">
                        <input class="contactus" placeholder="Your Name" type="type" name="Your Name">
                     </div>
                     <div class="col-md-6">
                        <input class="contactus" placeholder="Phone number" type="type" name="Phone number">
                     </div>
                     <div class="col-md-6">
                        <input class="contactus" placeholder="Email" type="type" name="Email">
                     </div>
                     <div class="col-md-12">
                        <textarea class="textarea" placeholder="Message" type="type" Message="Name">Message</textarea>
                     </div>
                     <div class="col-md-12">
                        <button class="send_btn">Send</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</body>

</html>
