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
<!-- Dining Section -->
<div class="bg-gray-100 py-16">
   <div class="max-w-6xl mx-auto px-4">
      <h2 class="text-3xl font-bold text-gray-800 text-center">
         Dining
      </h2>
      <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
         <!-- Gourmet Restaurant -->
         <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img alt="Elegant restaurant with modern decor and a variety of gourmet dishes" class="w-full h-48 object-cover" height="300" src="images/resto.jpg" width="400"/>
            <div class="p-4">
               <h3 class="text-xl font-bold text-gray-800">
                  Gourmet Restaurant
               </h3>
               <p class="mt-2 text-gray-600">
                  Savor exquisite dishes prepared by our world-class chefs.
               </p>
               <div class="mt-4 flex space-x-4">
                  <button class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition duration-300" onclick="toggleDetails('detailsResto')">
                     View Details
                  </button>
                  <a class="inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400 transition duration-300" href="#">
                     Book Now
                  </a>
               </div>
               <div id="detailsResto" class="mt-4 text-gray-600 hidden">
                  <ul>
                     <li><strong>Specialties:</strong> Gourmet steaks, fresh seafood, and a variety of fine wines.</li>
                     <li><strong>Ambience:</strong> Elegant, with a modern and cozy setting.</li>
                     <li><strong>Operating Hours:</strong> 12:00 PM - 10:00 PM</li>
                  </ul>
               </div>
            </div>
         </div>

         <!-- Cafe -->
         <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img alt="Cozy cafe with a variety of coffee and pastry options" class="w-full h-48 object-cover" height="300" src="images/cafe.jpg" width="400"/>
            <div class="p-4">
               <h3 class="text-xl font-bold text-gray-800">
                  Cafe
               </h3>
               <p class="mt-2 text-gray-600">
                  Enjoy a relaxing atmosphere with a variety of coffee and pastry options.
               </p>
               <div class="mt-4 flex space-x-4">
                  <button class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition duration-300" onclick="toggleDetails('detailsCafe')">
                     View Details
                  </button>
                  <a class="inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400 transition duration-300" href="#">
                     Book Now
                  </a>
               </div>
               <div id="detailsCafe" class="mt-4 text-gray-600 hidden">
                  <ul>
                     <li><strong>Specialties:</strong> Artisan coffee, freshly baked pastries, and sandwiches.</li>
                     <li><strong>Ambience:</strong> Cozy and casual, perfect for relaxation.</li>
                     <li><strong>Operating Hours:</strong> 7:00 AM - 6:00 PM</li>
                  </ul>
               </div>
            </div>
         </div>

         <!-- Bar -->
         <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img alt="Chic bar with a wide selection of cocktails and beverages" class="w-full h-48 object-cover" height="300" src="images/bar.jpg" width="400"/>
            <div class="p-4">
               <h3 class="text-xl font-bold text-gray-800">
                  Bar
               </h3>
               <p class="mt-2 text-gray-600">
                  Unwind with a wide selection of cocktails and beverages.
               </p>
               <div class="mt-4 flex space-x-4">
                  <button class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition duration-300" onclick="toggleDetails('detailsBar')">
                     View Details
                  </button>
                  <a class="inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400 transition duration-300" href="#">
                     Book Now
                  </a>
               </div>
               <div id="detailsBar" class="mt-4 text-gray-600 hidden">
                  <ul>
                     <li><strong>Specialties:</strong> Signature cocktails, fine wines, and premium spirits.</li>
                     <li><strong>Ambience:</strong> Chic and vibrant, ideal for a night out.</li>
                     <li><strong>Operating Hours:</strong> 5:00 PM - 12:00 AM</li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

