<?php
require_once 'config.php';
?>
<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Hotel Website
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
            font-family: 'Roboto', sans-serif;
        }
  </style>
 </head>
 <!-- Amenities Section -->
 <div class="bg-white py-16">
   <div class="max-w-6xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-gray-800 text-center">
     Amenities
    </h2>
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
     <div class="text-center">
      <img alt="Icon representing a swimming pool" class="mx-auto mb-4" height="100" src="images\swin.jpg" width="100"/>
      <h3 class="text-xl font-bold text-gray-800">
       Swimming Pool
      </h3>
      <p class="mt-2 text-gray-600">
       Enjoy a refreshing swim in our outdoor pool.
      </p>
     </div>
     <div class="text-center">
      <img alt="Icon representing a fitness center" class="mx-auto mb-4" height="100" src="images\sallesport.jpg" width="100"/>
      <h3 class="text-xl font-bold text-gray-800">
       Fitness Center
      </h3>
      <p class="mt-2 text-gray-600">
       Stay fit and healthy with our state-of-the-art gym facilities.
      </p>
     </div>
     <div class="text-center">
      <img alt="Icon representing a spa" class="mx-auto mb-4" height="100" src="images\spa.jpg" width="100"/>
      <h3 class="text-xl font-bold text-gray-800">
       Spa
      </h3>
      <p class="mt-2 text-gray-600">
       Relax and rejuvenate with our luxurious spa treatments.
      </p>
     </div>
    </div>
   </div>
  </div>
 