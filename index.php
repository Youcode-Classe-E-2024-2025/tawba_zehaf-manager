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
 <body class="bg-gray-100">
  <!-- Navbar -->
  <nav class="bg-white shadow-lg">
   <div class="max-w-6xl mx-auto px-4">
    <div class="flex justify-between">
     <div class="flex space-x-7">
      <div>
       <a class="flex items-center py-4 px-2" href="#">
        <img alt="Hotel logo with a stylized building and sun" class="h-8 w-8 mr-2" height="50" src="images\hotel.jpg" width="50"/>
        <span class="font-semibold text-gray-500 text-lg">
         HotelTawba
        </span>
       </a>
      </div>
      <div class="hidden md:flex items-center space-x-1">
       <a class="py-4 px-2 text-gray-500 border-b-4 border-blue-500 font-semibold" href="index.php">
        Home
       </a>
       <a class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300" href="rooms.php">
        Rooms
       </a>
       <a class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300" href="#">
        Amenities
       </a>
       <a class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300" href="#">
        Dining
       </a>
       <a class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300" href="#">
        Contact
       </a>
      </div>
     </div>
     <div class="hidden md:flex items-center space-x-3">
      <a class="py-2 px-2 font-medium text-gray-500 rounded hover:bg-gray-200 transition duration-300" href="login.php">
       Log In
      </a>
      <a class="py-2 px-2 font-medium text-white bg-blue-500 rounded hover:bg-blue-400 transition duration-300" href="signup.php">
       Sign Up
      </a>
     </div>
     <div class="md:hidden flex items-center">
      <button class="outline-none mobile-menu-button">
       <i class="fas fa-bars">
       </i>
      </button>
     </div>
    </div>
   </div>
  </nav>
  <div class="hidden mobile-menu">
   <ul class="">
    <li>
     <a class="block text-sm px-2 py-4 text-white bg-blue-500 font-semibold" href="#">
      Home
     </a>
    </li>
    <li>
     <a class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300" href="#">
      Rooms
     </a>
    </li>
    <li>
     <a class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300" href="#">
      Amenities
     </a>
    </li>
    <li>
     <a class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300" href="#">
      Dining
     </a>
    </li>
    <li>
     <a class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300" href="#">
      Contact
     </a>
    </li>
   </ul>
  </div>
  <!-- Hero Section -->
  <div class="bg-white">
   <div class="max-w-6xl mx-auto px-4 py-16 text-center">
    <h1 class="text-4xl font-bold text-gray-800">
     Welcome to HotelTawba
    </h1>
    <p class="mt-4 text-gray-600">
     Experience luxury and comfort in the heart of the city.
    </p>
    <a class="mt-8 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition duration-300" href="#">
     Book Now
    </a>
   </div>
  </div>
 <!-- Rooms Section -->
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
  <!-- Dining Section -->
<div class="bg-gray-100 py-16">
   <div class="max-w-6xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-gray-800 text-center">
     Dining
    </h2>
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
     <!-- Gourmet Restaurant -->
     <div class="bg-white shadow-lg rounded-lg overflow-hidden">
      <img alt="Elegant restaurant with modern decor and a variety of gourmet dishes" class="w-full h-48 object-cover" height="300" src="images\resto.jpg" width="400"/>
      <div class="p-4">
       <h3 class="text-xl font-bold text-gray-800">
        Gourmet Restaurant
       </h3>
       <p class="mt-2 text-gray-600">
        Savor exquisite dishes prepared by our world-class chefs.
       </p>
       <div class="mt-4 flex space-x-4">
        <a class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition duration-300" href="#">
         View Menu
        </a>
        <a class="inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400 transition duration-300" href="#">
         Book Now
        </a>
       </div>
      </div>
     </div>

     <!-- Cafe -->
     <div class="bg-white shadow-lg rounded-lg overflow-hidden">
      <img alt="Cozy cafe with a variety of coffee and pastry options" class="w-full h-48 object-cover" height="300" src="images\cafe.jpg" width="400"/>
      <div class="p-4">
       <h3 class="text-xl font-bold text-gray-800">
        Cafe
       </h3>
       <p class="mt-2 text-gray-600">
        Enjoy a relaxing atmosphere with a variety of coffee and pastry options.
       </p>
       <div class="mt-4 flex space-x-4">
        <a class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition duration-300" href="#">
         View Menu
        </a>
        <a class="inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400 transition duration-300" href="#">
         Book Now
        </a>
       </div>
      </div>
     </div>

     <!-- Bar -->
     <div class="bg-white shadow-lg rounded-lg overflow-hidden">
      <img alt="Chic bar with a wide selection of cocktails and beverages" class="w-full h-48 object-cover" height="300" src="images\bar.jpg" width="400"/>
      <div class="p-4">
       <h3 class="text-xl font-bold text-gray-800">
        Bar
       </h3>
       <p class="mt-2 text-gray-600">
        Unwind with a wide selection of cocktails and beverages.
       </p>
       <div class="mt-4 flex space-x-4">
        <a class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition duration-300" href="#">
         View Menu
        </a>
        <a class="inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400 transition duration-300" href="#">
         Book Now
        </a>
       </div>
      </div>
     </div>
    </div>
   </div>
</div>

  <!-- Contact Section -->
  <div class="bg-white py-16">
   <div class="max-w-6xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-gray-800 text-center">
     Contact Us
    </h2>
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
     <div>
      <h3 class="text-xl font-bold text-gray-800">
       Get in Touch
      </h3>
      <p class="mt-2 text-gray-600">
       We'd love to hear from you! Whether you have a question about our services or need assistance, feel free to reach out.
      </p>
      <form class="mt-4">
       <div class="mb-4">
        <label class="block text-gray-700">
         Name
        </label>
        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your Name" type="text"/>
       </div>
       <div class="mb-4">
        <label class="block text-gray-700">
         Email
        </label>
        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your Email" type="email"/>
       </div>
       <div class="mb-4">
        <label class="block text-gray-700">
         Message
        </label>
        <textarea class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your Message" rows="4"></textarea>
       </div>
       <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition duration-300" type="submit">
        Send Message
       </button>
      </form>
     </div>
     <div>
      <h3 class="text-xl font-bold text-gray-800">
       Contact Information
      </h3>
      <p class="mt-2 text-gray-600">
       123 Hotel Street, City, Country
      </p>
      <p class="mt-2 text-gray-600">
       Phone: (123) 456-7890
      </p>
      <p class="mt-2 text-gray-600">
       Email: info@hotelTawba.com
      </p>
      <div class="mt-4">
       <h3 class="text-xl font-bold text-gray-800">
        Follow Us
       </h3>
       <div class="flex space-x-4 mt-2">
        <a class="text-gray-500 hover:text-blue-500 transition duration-300" href="#">
         <i class="fab fa-facebook-f">
         </i>
        </a>
        <a class="text-gray-500 hover:text-blue-500 transition duration-300" href="#">
         <i class="fab fa-twitter">
         </i>
        </a>
        <a class="text-gray-500 hover:text-blue-500 transition duration-300" href="#">
         <i class="fab fa-instagram">
         </i>
        </a>
        <a class="text-gray-500 hover:text-blue-500 transition duration-300" href="#">
         <i class="fab fa-linkedin-in">
         </i>
        </a>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
  <!-- Footer -->
  <footer class="bg-gray-800 py-8">
   <div class="max-w-6xl mx-auto px-4">
    <div class="flex justify-between items-center">
     <div class="text-white">
      <h3 class="text-lg font-bold">
       HotelTawba
      </h3>
      <p class="mt-2 text-gray-400">
       © 2023 HotelTawba. All rights reserved.
      </p>
     </div>
     <div class="flex space-x-4">
      <a class="text-gray-400 hover:text-white transition duration-300" href="#">
       Privacy Policy
      </a>
      <a class="text-gray-400 hover:text-white transition duration-300" href="#">
       Terms of Service
      </a>
     </div>
    </div>
   </div>
  </footer>
  <script src="script.js"></script>

 </body>
</html>
