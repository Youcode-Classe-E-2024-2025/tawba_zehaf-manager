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