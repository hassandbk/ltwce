<!-- Left: Demo Form -->
<div class="w-full lg:w-1/2 px-4">
  <div class="flex flex-col justify-center h-full min-h-[calc(100vh-5rem)] py-12">
    <div class="max-w-md mx-auto w-full bg-white p-8 rounded-xl shadow-lg">
      <h1 class="font-dm-serif text-4xl sm:text-5xl font-bold text-slate-800 mb-8 text-center">
        Request Your Demo
      </h1>
      <form class="space-y-6">
        <div>
          <label for="email" class="block text-sm font-medium mb-1">Email <span class="text-rose-500">*</span></label>
          <input id="email" type="email" required
            class="w-full border border-slate-200 rounded px-4 py-2 focus:border-blue-500" />
        </div>
        <div>
          <label for="name" class="block text-sm font-medium mb-1">Name <span class="text-rose-500">*</span></label>
          <input id="name" type="text" required
            class="w-full border border-slate-200 rounded px-4 py-2 focus:border-blue-500" />
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="city" class="block text-sm font-medium mb-1">City <span class="text-rose-500">*</span></label>
            <input id="city" type="text" required
              class="w-full border border-slate-200 rounded px-4 py-2 focus:border-blue-500" />
          </div>
          <div>
            <label for="pcode" class="block text-sm font-medium mb-1">Postal Code <span
                class="text-rose-500">*</span></label>
            <input id="pcode" type="text" required
              class="w-full border border-slate-200 rounded px-4 py-2 focus:border-blue-500" />
          </div>
        </div>
        <div>
          <label for="address" class="block text-sm font-medium mb-1">Address <span
              class="text-rose-500">*</span></label>
          <input id="address" type="text" required
            class="w-full border border-slate-200 rounded px-4 py-2 focus:border-blue-500" />
        </div>
        <div>
          <label for="country" class="block text-sm font-medium mb-1">Country <span
              class="text-rose-500">*</span></label>
          <select id="country" required class="w-full border border-slate-200 rounded px-4 py-2 focus:border-blue-500">
            <option>United States</option>
            <option>United Kingdom</option>
            <option>Germany</option>
          </select>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
          Submit Request
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Right: Testimonial -->
<div class="w-full lg:w-1/2 px-4 mt-12 lg:mt-0 relative">
  <div class="absolute inset-0">
    <img src="images/request-demo-bg.jpg" alt="Background" class="w-full h-full object-cover opacity-10" />
  </div>
  <div class="relative z-10 flex items-center justify-center h-full min-h-[calc(100vh-5rem)] py-12">
    <div class="max-w-lg mx-auto bg-white bg-opacity-80 p-8 rounded-xl shadow-xl">
      <h2 class="font-dm-serif text-3xl sm:text-4xl font-bold mb-4 text-center text-slate-900">
        Black Inc.
      </h2>
      <blockquote class="text-slate-700 italic mb-6 leading-relaxed">
        “Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur…”
      </blockquote>
      <div class="flex items-center">
        <img src="images/customer-avatar-04.jpg" alt="Christine Duck" class="w-12 h-12 rounded-full mr-4" />
        <div>
          <p class="text-sm font-medium text-slate-800">
            Christine Duck
          </p>
          <p class="text-sm text-slate-500">CEO, Black Inc.</p>
        </div>
      </div>
    </div>
  </div>
</div>