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
<div class="bg-gray-100 py-16">
   <div class="max-w-6xl mx-auto px-4">
      <h2 class="text-3xl font-bold text-gray-800 text-center">
         Our Rooms
      </h2>
      <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
         <!-- Deluxe Room -->
         <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img alt="Luxurious room with a king-sized bed, modern decor, and a large window with a city view" class="w-full h-48 object-cover" height="300" src="images\room.jpg" width="400"/>
            <div class="p-4">
               <h3 class="text-xl font-bold text-gray-800">
                  Deluxe Room
               </h3>
               <p class="mt-2 text-gray-600">
                  A spacious room with a king-sized bed, modern amenities, and a stunning city view.
               </p>
               <div class="mt-4 flex space-x-4">
                  <button class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition duration-300" onclick="toggleDetails('details1')">
                     View Details
                  </button>
                  <a class="inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400 transition duration-300" href="reservation.php">
                     Book Now
                  </a>
               </div>
               <div id="details1" class="mt-4 text-gray-600 hidden">
                  <ul>
                     <li><strong>Size:</strong> 400 sq ft</li>
                     <li><strong>Amenities:</strong> King-sized bed, high-speed Wi-Fi, 50" Smart TV, minibar, work desk, and a luxurious bathroom with a rain shower.</li>
                     <li><strong>View:</strong> Panoramic city view</li>
                     <li><strong>Additional Features:</strong> Complimentary breakfast, 24-hour room service, daily housekeeping, and free access to the fitness center.</li>
                  </ul>
               </div>
            </div>
         </div>

         <!-- Executive Suite -->
         <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img alt="Elegant suite with a separate living area, luxurious furnishings, and a panoramic city view" class="w-full h-48 object-cover" height="300" src="images\room2.jpg" width="400"/>
            <div class="p-4">
               <h3 class="text-xl font-bold text-gray-800">
                  Executive Suite
               </h3>
               <p class="mt-2 text-gray-600">
                  An elegant suite with a separate living area, luxurious furnishings, and a panoramic city view.
               </p>
               <div class="mt-4 flex space-x-4">
                  <button class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition duration-300" onclick="toggleDetails('details2')">
                     View Details
                  </button>
                  <a class="inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400 transition duration-300" href="reservation.php">
                     Book Now
                  </a>
               </div>
               <div id="details2" class="mt-4 text-gray-600 hidden">
                  <ul>
                     <li><strong>Size:</strong> 650 sq ft</li>
                     <li><strong>Amenities:</strong> Separate living area with sofa, king-sized bed, 65" Smart TV, minibar, coffee maker, and a spacious bathroom with a soaking tub and separate shower.</li>
                     <li><strong>View:</strong> Breathtaking panoramic city view from floor-to-ceiling windows</li>
                     <li><strong>Additional Features:</strong> Priority check-in, personalized concierge service, access to the executive lounge, and exclusive spa treatments.</li>
                  </ul>
               </div>
            </div>
         </div>

         <!-- Standard Room -->
         <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img alt="Cozy room with a queen-sized bed, modern decor, and a garden view" class="w-full h-48 object-cover" height="300" src="images\room3.jpg" width="400"/>
            <div class="p-4">
               <h3 class="text-xl font-bold text-gray-800">
                  Standard Room
               </h3>
               <p class="mt-2 text-gray-600">
                  A cozy room with a queen-sized bed, modern decor, and a garden view.
               </p>
               <div class="mt-4 flex space-x-4">
                  <button class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition duration-300" onclick="toggleDetails('details3')">
                     View Details
                  </button>
                  <a class="inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400 transition duration-300" href="reservation.php">
                     Book Now
                  </a>
               </div>
               <div id="details3" class="mt-4 text-gray-600 hidden">
                  <ul>
                     <li><strong>Size:</strong> 300 sq ft</li>
                     <li><strong>Amenities:</strong> Queen-sized bed, work desk, 40" TV, mini-fridge, and a modern bathroom with a shower and toiletries.</li>
                     <li><strong>View:</strong> Peaceful garden view</li>
                     <li><strong>Additional Features:</strong> Complimentary bottled water, free Wi-Fi, and daily housekeeping.</li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
