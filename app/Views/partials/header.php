<header class="fixed w-full z-30 bg-slate-900 text-white shadow-lg" x-data="{ mobileOpen: false }">
  <div class="max-w-7xl mx-auto px-5 sm:px-6 flex items-center justify-between py-4">
    <div class="flex items-center space-x-8">
      <a href="<?= site_url() ?>" class="flex items-center space-x-3 group">
        <img src="<?= base_url('assets/images/logo.png') ?>" alt="LTWCE SACCO Logo" width="40" height="40"
          class="group-hover:scale-110 transition-transform duration-300" />
        <span class="font-playfair text-2xl group-hover:text-yellow-400 transition-colors duration-300">LTWCE
          SACCO</span>
      </a>

      <nav class="hidden md:flex items-center space-x-6">

        <div x-data="{ open: false, timeout: null }" @mouseenter="clearTimeout(timeout); open = true"
          @mouseleave="timeout = setTimeout(() => open = false, 300)" class="relative group">

          <button @click="open = !open" :aria-expanded="open" aria-haspopup="true"
            class="flex items-center text-base font-medium hover:text-yellow-400 focus:outline-none transition-colors duration-200">
            Products
            <svg class="ml-1 w-4 h-4 fill-current group-hover:rotate-180 transition-transform duration-300"
              viewBox="0 0 12 12">
              <path
                d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
            </svg>
          </button>

          <ul x-show="open" x-cloak x-transition.opacity.duration.200ms
            class="absolute right-0 mt-2 w-56 bg-white text-slate-800 rounded shadow-xl py-2 border border-yellow-200 overflow-visible z-10">

            <li x-data="{ subOpen: false }" @mouseenter="subOpen = true" @mouseleave="subOpen = false" class="relative">
              <a href="#" @click.prevent="subOpen = !subOpen"
                class="flex justify-between items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                <span class="flex items-center">
                  <i class="fa-solid fa-hand-holding-dollar mr-2 text-yellow-600 transition-all duration-300"></i>
                  Loans
                </span>
                <svg class="ml-auto w-4 h-4 fill-current transform transition-transform duration-300"
                  :class="subOpen ? '-rotate-90' : ''" viewBox="0 0 12 12">
                  <path
                    d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
                </svg>
              </a>

              <ul x-show="subOpen" x-transition.opacity.duration.200ms
                class="absolute left-full top-0 ml-2 w-64 bg-white text-slate-800 rounded shadow-xl py-2 z-20 border border-yellow-200 overflow-hidden">
                <li><a href="<?= site_url('products/loans/personal') ?>"
                    class="block px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fa-solid fa-user mr-2 text-blue-600 transition-all duration-300"></i>
                    Personal Loans
                  </a>
                </li>
                <li><a href="<?= site_url('products/loans/business') ?>"
                    class="block px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fa-solid fa-briefcase mr-2 text-green-600 transition-all duration-300"></i>
                    Business Loans
                  </a>
                </li>
                <li><a href="<?= site_url('products/loans/education') ?>"
                    class="block px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fa-solid fa-graduation-cap mr-2 text-purple-600 transition-all duration-300"></i>
                    Education Loans
                  </a>
                </li>
                <li><a href="<?= site_url('products/loans/microfinance') ?>"
                    class="block px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fa-solid fa-hand-holding-usd mr-2 text-orange-600 transition-all duration-300"></i>
                    Microfinance Loans
                  </a>
                </li>
              </ul>
            </li>

            <li x-data="{ subOpen: false }" @mouseenter="subOpen = true" @mouseleave="subOpen = false" class="relative">
              <a href="#" @click.prevent="subOpen = !subOpen"
                class="flex justify-between items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                <span class="flex items-center">
                  <i class="fa-solid fa-piggy-bank mr-2 text-yellow-600 transition-all duration-300"></i>
                  Savings Accounts
                </span>
                <svg class="ml-auto w-4 h-4 fill-current transform transition-transform duration-300"
                  :class="subOpen ? '-rotate-90' : ''" viewBox="0 0 12 12">
                  <path
                    d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
                </svg>
              </a>

              <ul x-show="subOpen" x-transition.opacity.duration.200ms
                class="absolute left-full top-0 ml-2 w-64 bg-white text-slate-800 rounded shadow-xl py-2 z-20 border border-yellow-200 overflow-hidden">
                <li><a href="<?= site_url('products/savings/ordinary') ?>"
                    class="block px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fa-solid fa-coins mr-2 text-orange-600 transition-all duration-300"></i>
                    Ordinary Savings
                  </a>
                </li>
                <li><a href="<?= site_url('products/savings/fixed') ?>"
                    class="block px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fa-solid fa-lock mr-2 text-red-600 transition-all duration-300"></i>
                    Fixed Deposit
                  </a>
                </li>
                <li><a href="<?= site_url('products/savings/junior') ?>"
                    class="block px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fa-solid fa-child mr-2 text-cyan-600 transition-all duration-300"></i>
                    Junior Savings
                  </a>
                </li>
              </ul>
            </li>

            <li>
              <a href="<?= site_url('products/shares') ?>"
                class="block px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                <i class="fa-solid fa-chart-line mr-2 text-indigo-600 transition-all duration-300"></i>
                Share Capital
              </a>
            </li>
            <li>
              <a href="<?= site_url('products/insurance') ?>"
                class="block px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                <i class="fa-solid fa-shield-alt mr-2 text-pink-600 transition-all duration-300"></i>
                Insurance Products
              </a>
            </li>

          </ul>
        </div>

        <a href="<?= site_url('services') ?>"
          class="text-base font-medium hover:text-yellow-400 focus:outline-none transition-colors duration-200">Services</a>

        <div x-data="{ open: false, timeout: null }" @mouseenter="clearTimeout(timeout); open = true"
          @mouseleave="timeout = setTimeout(() => open = false, 300)" class="relative group">

          <button @click="open = !open" :aria-expanded="open" aria-haspopup="true"
            class="flex items-center text-base font-medium hover:text-yellow-400 focus:outline-none transition-colors duration-200">

            Resources
            <svg class="ml-1 w-4 h-4 fill-current group-hover:rotate-180 transition-transform duration-300"
              viewBox="0 0 12 12">
              <path
                d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
            </svg>
          </button>

          <ul x-show="open" x-cloak x-transition.opacity.duration.200ms
            class="absolute right-0 mt-2 w-64 bg-white text-slate-800 rounded shadow-xl py-2 border border-yellow-200 overflow-visible z-10">

            <li x-data="{ subOpen: false }" @mouseenter="subOpen = true" @mouseleave="subOpen = false"
              class="relative overflow-visible">
              <a href="#" @click.prevent="subOpen = !subOpen"
                class="flex justify-between items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                <span class="flex items-center">
                  <i class="fa-solid fa-user-friends mr-2 text-yellow-600"></i>
                  Membership Hub
                </span>
                <svg class="ml-auto w-4 h-4 fill-current transform transition-transform duration-300"
                  :class="subOpen ? '-rotate-90' : ''" viewBox="0 0 12 12">
                  <path
                    d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
                </svg>
              </a>

              <ul x-show="subOpen" x-cloak x-transition.opacity.duration.200ms
                class="absolute left-full top-0 ml-2 w-56 bg-white text-slate-800 rounded shadow-xl py-2 z-20 border border-yellow-200 overflow-visible">

                <li>
                  <a href="<?= site_url('resources/membership-hub/faqs') ?>"
                    class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fa-solid fa-question-circle mr-2 text-blue-600"></i>
                    FAQs
                  </a>
                </li>

                <li x-data="{ subSubOpen: false }" @mouseenter="subSubOpen = true" @mouseleave="subSubOpen = false"
                  class="relative overflow-visible">
                  <a href="#" @click.prevent="subSubOpen = !subSubOpen"
                    class="flex justify-between items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <span class="flex items-center">
                      <i class="fa-solid fa-file-download mr-2 text-orange-600"></i>
                      Downloads/Forms
                    </span>
                    <svg class="ml-auto w-4 h-4 fill-current transform transition-transform duration-300"
                      :class="subSubOpen ? '-rotate-90' : ''" viewBox="0 0 12 12">
                      <path
                        d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
                    </svg>
                  </a>

                  <ul x-show="subSubOpen" x-cloak x-transition.opacity.duration.200ms class="absolute left-full top-0 ml-2 w-56 bg-white text-slate-800 rounded shadow-xl py-2 z-30 border
                                    border-yellow-200 overflow-visible">
                    <li>
                      <a href="<?= site_url('resources/downloads/membership-application') ?>"
                        class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                        <i class="fa-solid fa-id-card mr-2 text-lime-600"></i>
                        Membership Application
                      </a>
                    </li>
                    <li>
                      <a href="<?= site_url('resources/downloads/loan-application') ?>"
                        class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                        <i class="fa-solid fa-money-bill-wave mr-2 text-teal-600"></i>
                        Loan Application Forms
                      </a>
                    </li>
                    <li>
                      <a href="<?= site_url('resources/downloads/savings-opening') ?>"
                        class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                        <i class="fa-solid fa-wallet mr-2 text-cyan-600"></i>
                        Savings Account Opening
                      </a>
                    </li>
                    <li>
                      <a href="<?= site_url('resources/downloads/withdrawal-forms') ?>"
                        class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                        <i class="fa-solid fa-file-export mr-2 text-indigo-600"></i>
                        Withdrawal Forms
                      </a>
                    </li>
                    <li>
                      <a href="<?= site_url('resources/downloads/kyc-checklist') ?>"
                        class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                        <i class="fa-solid fa-clipboard-check mr-2 text-pink-600"></i>
                        KYC Documents Checklist
                      </a>
                    </li>
                  </ul>
                </li>

              </ul>
            </li>

            <li x-data="{ subOpen: false }" @mouseenter="subOpen = true" @mouseleave="subOpen = false"
              class="relative overflow-visible">
              <a href="#" @click.prevent="subOpen = !subOpen"
                class="flex justify-between items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                <span class="flex items-center">
                  <i class="fa-solid fa-gavel mr-2 text-yellow-600"></i>
                  Policies & Legal
                </span>
                <svg class="ml-auto w-4 h-4 fill-current transform transition-transform duration-300"
                  :class="subOpen ? '-rotate-90' : ''" viewBox="0 0 12 12">
                  <path
                    d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
                </svg>
              </a>
              <ul x-show="subOpen" x-cloak x-transition.opacity.duration.200ms
                class="absolute left-full top-0 ml-2 w-56 bg-white text-slate-800 rounded shadow-xl py-2 z-20 border border-yellow-200 overflow-visible">
                <li>
                  <a href="<?= site_url('resources/policies/privacy-policy') ?>"
                    class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fa-solid fa-shield-alt mr-2 text-blue-600"></i>
                    Privacy Policy
                  </a>
                </li>
                <li>
                  <a href=" <?= site_url('resources/policies/terms-conditions') ?>"
                    class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fa-solid fa-file-contract mr-2 text-red-600"></i>
                    Terms & Conditions
                  </a>
                </li>
                <li>
                  <a href=" <?= site_url('resources/policies/loan-policy') ?>"
                    class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fa-solid fa-handshake mr-2 text-green-600"></i>
                    Loan Policy
                  </a>
                </li>
                <li>
                  <a href=" <?= site_url('resources/policies/savings-policy') ?>"
                    class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fa-solid fa-money-bill-transfer mr-2 text-purple-600"></i>
                    Savings Policy
                  </a>
                </li>
                <li>
                  <a href=" <?= site_url('resources/policies/complaint-resolution') ?>"
                    class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fa-solid fa-wrench mr-2 text-orange-600"></i>
                    Complaint Resolution
                  </a>
                </li>
              </ul>
            </li>

            <li>
              <a href="<?= site_url('resources/articles') ?>"
                class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                <i class="fa-solid fa-newspaper mr-2 text-purple-600"></i>
                News & Articles
              </a>
            </li>

            <li>
              <a href="<?= site_url('resources/testimonials') ?>"
                class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                <i class="fa-solid fa-quote-right mr-2 text-cyan-600"></i>
                Testimonials
              </a>
            </li>

          </ul>
        </div>

        <div x-data="{ open: false, timeout: null }" @mouseenter="clearTimeout(timeout); open = true"
          @mouseleave="timeout = setTimeout(() => open = false, 300)" class="relative group">

          <button @click="open = !open" :aria-expanded="open" aria-haspopup="true"
            class="flex items-center text-base font-medium hover:text-yellow-400 focus:outline-none transition-colors duration-200">
            About Us
            <svg class="ml-1 w-4 h-4 fill-current group-hover:rotate-180 transition-transform duration-300"
              viewBox="0 0 12 12">
              <path
                d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
            </svg>
          </button>

          <ul x-show="open" x-cloak x-transition.opacity.duration.200ms
            class="absolute right-0 mt-2 w-64 bg-white text-slate-800 rounded shadow-xl py-2 border border-yellow-200 overflow-visible">

            <li>
              <a href="<?= site_url('about/our-story') ?>"
                class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                <i class="fa-solid fa-book-open mr-2 text-indigo-500"></i>
                Our Story
              </a>
            </li>

            <li>
              <a href="<?= site_url('about/mission-values') ?>"
                class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                <i class="fa-solid fa-bullseye mr-2 text-green-500"></i>
                Mission &amp; Values
              </a>
            </li>

            <li x-data="{ subOpen: false }" @mouseenter="subOpen = true" @mouseleave="subOpen = false" class="relative">
              <a href="#" @click.prevent="subOpen = !subOpen"
                class="flex justify-between items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                <span class="flex items-center">
                  <i class="fa-solid fa-users mr-2 text-blue-500"></i>
                  Our Team
                </span>
                <svg class="ml-auto w-4 h-4 fill-current transform transition-transform duration-300"
                  :class="subOpen ? '-rotate-90' : ''" viewBox="0 0 12 12">
                  <path
                    d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
                </svg>
              </a>
              <ul x-show="subOpen" x-transition.opacity.duration.200ms
                class="absolute left-full top-0 ml-2 w-60 bg-white text-slate-800 rounded shadow-xl py-2 z-20 border border-yellow-200 overflow-hidden">
                <li>
                  <a href="<?= site_url('about/team/leadership') ?>"
                    class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fa-solid fa-chess-queen mr-2 text-purple-500"></i>
                    Leadership Team
                  </a>
                </li>
                <li>
                  <a href="<?= site_url('about/team/board') ?>"
                    class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fa-solid fa-landmark mr-2 text-teal-500"></i>
                    Board Members
                  </a>
                </li>
                <li>
                  <a href="<?= site_url('about/team/management') ?>"
                    class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                    <i class="fa-solid fa-briefcase mr-2 text-orange-500"></i>
                    Management
                  </a>
                </li>
              </ul>
            </li>

            <li>
              <a href="<?= site_url('about/careers') ?>"
                class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                <i class="fa-solid fa-briefcase-medical mr-2 text-red-500"></i>
                Careers
              </a>
            </li>

            <li>
              <a href="<?= site_url('about/partnership') ?>"
                class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                <i class="fa-solid fa-handshake-angle mr-2 text-yellow-500"></i>
                Partnership
              </a>
            </li>

            <li>
              <a href="<?= site_url('about/contact') ?>"
                class="flex items-center px-4 py-2 text-sm hover:bg-yellow-100 transition-colors duration-200">
                <i class="fa-solid fa-envelope mr-2 text-pink-500"></i>
                Contact Us
              </a>
            </li>

          </ul>
        </div>


      </nav>
    </div>

    <div class="hidden md:flex items-center space-x-4">
      <a href="#" @click.prevent="open('login')" class="text-base font-medium hover:text-yellow-400 transition-colors duration-200
                hidden lg:inline-flex items-center">
        Sign in
      </a>
      <a href="#" @click.prevent="open('login')"
        class="hidden md:inline-flex lg:hidden items-center text-base font-medium hover:text-yellow-400 transition-colors duration-200 p-2 rounded-full hover:bg-slate-800"
        title="Sign In">
        <i class="fa-solid fa-sign-in-alt text-lg"></i>
      </a>

      <a href="#" @click.prevent="open('signup')"
        class="hidden lg:inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition-colors duration-200 group">
        Join LTWCE <span class="ml-2 group-hover:translate-x-1 transition-transform duration-200">→</span>
      </a>
      <a href="#" @click.prevent="open('signup')"
        class="hidden md:inline-flex lg:hidden items-center px-3 py-2 bg-yellow-500 text-white rounded-full hover:bg-yellow-600 transition-colors duration-200 group"
        title="Join LTWCE">
        <i class="fa-solid fa-user-plus text-lg"></i>
      </a>
    </div>

    <button @click="mobileOpen = !mobileOpen" aria-label="Toggle mobile menu" :aria-expanded="mobileOpen"
      class="md:hidden p-2 text-white hover:text-yellow-200 focus:outline-none">
      <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16" class="transition-transform duration-300" />
        <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M6 18L18 6M6 6l12 12" class="transition-transform duration-300" />
      </svg>
    </button>
  </div>

  <nav id="mobile-nav" x-show="mobileOpen" x-cloak @click.away="mobileOpen = false"
    @keydown.escape.window="mobileOpen = false" x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-4"
    class="md:hidden bg-white text-slate-800 border-t border-slate-200 shadow-lg absolute w-full right-0 py-4"
    x-data="{ expandedMenu: null, expandedSubMenu: null, expandedSubSubMenu: null }">
    <ul class="space-y-1 px-5">
      <li class="space-y-1">
        <button
          @click="expandedMenu = (expandedMenu === 'products' ? null : 'products'); expandedSubMenu = null; expandedSubSubMenu = null;"
          class="w-full text-left px-3 py-2 rounded hover:bg-yellow-100 flex justify-between items-center transition-colors duration-200">
          <span class="flex items-center">
            Products
          </span>
          <svg :class="{ 'rotate-180': expandedMenu === 'products' }" class="w-5 h-5 transition-transform"
            viewBox="0 0 12 12">
            <path
              d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
          </svg>
        </button>
        <ul x-show="expandedMenu === 'products'" x-transition.opacity.duration.200ms class="pl-4 space-y-1">
          <li class="space-y-1">
            <button
              @click="expandedSubMenu = (expandedSubMenu === 'loans' ? null : 'loans'); expandedSubSubMenu = null;"
              class="w-full text-left px-3 py-2 rounded hover:bg-yellow-100 flex justify-between items-center transition-colors duration-200">
              <span class="flex items-center"><i class="fa-solid fa-hand-holding-dollar mr-3 text-yellow-600"></i>
                Loans</span>
              <svg :class="{ 'rotate-180': expandedSubMenu === 'loans' }" class="w-5 h-5 transition-transform"
                viewBox="0 0 12 12">
                <path
                  d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
              </svg>
            </button>
            <ul x-show="expandedSubMenu === 'loans'" x-transition.opacity.duration.200ms class="pl-4 space-y-1">
              <li><a href="<?= site_url('products/loans/personal') ?>"
                  class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                    class="flex items-center"><i class="fa-solid fa-user mr-3 text-blue-600"></i> Personal
                    Loans</span>
                  < /a>
              </li>
              <li><a href="<?= site_url('products/loans/business') ?>"
                  class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                    class="flex items-center"><i class="fa-solid fa-briefcase mr-3 text-green-600"></i> Business
                    Loans</span>
                  < /a>
              </li>
              <li><a href="<?= site_url('products/loans/education') ?>"
                  class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                    class="flex items-center"><i class="fa-solid fa-graduation-cap mr-3 text-purple-600"></i>
                    Education
                    Loans</span></a></li>
              <li><a href="<?= site_url('products/loans/microfinance') ?>"
                  class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                    class="flex items-center"><i class="fa-solid fa-hand-holding-usd mr-3 text-orange-600"></i>
                    Microfinance Loans</span></a></li>
            </ul>
          </li>
          <li class="space-y-1">
            <button
              @click="expandedSubMenu = (expandedSubMenu === 'savings' ? null : 'savings'); expandedSubSubMenu = null;"
              class="w-full text-left px-3 py-2 rounded hover:bg-yellow-100 flex justify-between items-center transition-colors duration-200">
              <span class="flex items-center"><i class="fa-solid fa-piggy-bank mr-3 text-yellow-600"></i> Savings
                Accounts</span>
              <svg :class="{ 'rotate-180': expandedSubMenu === 'savings' }" class="w-5 h-5 transition-transform"
                viewBox="0 0 12 12">
                <path d=" M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0
                10-1.414-1.414z" />
              </svg>
            </button>
            <ul x-show="expandedSubMenu === 'savings'" x-transition.opacity.duration.200ms class="pl-4 space-y-1">
              <li><a href="<?= site_url('products/savings/ordinary') ?>"
                  class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                    class="flex items-center"><i class="fa-solid fa-coins mr-3 text-orange-600"></i> Ordinary
                    Savings</span></a></li>
              <li><a href="<?= site_url('products/savings/fixed') ?>"
                  class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                    class="flex items-center"><i class="fa-solid fa-lock mr-3 text-red-600"></i> Fixed
                    Deposit</span></a></li>
              <li><a href="<?= site_url('products/savings/junior') ?>"
                  class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                    class="flex items-center"><i class="fa-solid fa-child mr-3 text-cyan-600"></i> Junior
                    Savings</span></a></li>
            </ul>
          </li>
          <li><a href="<?= site_url('products/shares') ?>"
              class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                class="flex items-center"><i class="fa-solid fa-chart-line mr-3 text-indigo-600"></i> Share
                Capital</span></a></li>
          <li><a href="<?= site_url('products/insurance') ?>"
              class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                class="flex items-center"><i class="fa-solid fa-shield-alt mr-3 text-pink-600"></i> Insurance
                Products</span></a></li>
        </ul>
      </li>

      <li><a href="<?= site_url('services') ?>"
          class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
            class="flex items-center">
            Services</span></a></li>

      <li class="space-y-1">
        <button
          @click="expandedMenu = (expandedMenu === 'resources' ? null : 'resources'); expandedSubMenu = null; expandedSubSubMenu = null;"
          class="w-full text-left px-3 py-2 rounded hover:bg-yellow-100 flex justify-between items-center transition-colors duration-200">
          <span class="flex items-center"> Resources</span>
          <svg :class="{ 'rotate-180': expandedMenu === 'resources' }" class="w-5 h-5 transition-transform"
            viewBox="0 0 12 12">
            <path
              d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
          </svg>
        </button>
        <ul x-show="expandedMenu === 'resources'" x-transition.opacity.duration.200ms class="pl-4 space-y-1">
          <li class="space-y-1">
            <button
              @click="expandedSubMenu = (expandedSubMenu === 'membership-hub' ? null : 'membership-hub'); expandedSubSubMenu = null;"
              class="w-full text-left px-3 py-2 rounded hover:bg-yellow-100 flex justify-between items-center transition-colors duration-200">
              <span class="flex items-center"><i class="fa-solid fa-user-friends mr-3 text-yellow-600"></i> Membership
                Hub</span>
              <svg :class="{ 'rotate-180': expandedSubMenu === 'membership-hub' }" class="w-5 h-5 transition-transform"
                viewBox="0 0 12 12">
                <path
                  d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
              </svg>
            </button>
            <ul x-show="expandedSubMenu === 'membership-hub'" x-transition.opacity.duration.200ms
              class="pl-4 space-y-1">
              <li><a href="<?= site_url('resources/membership-hub/faqs') ?>"
                  class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                    class="flex items-center"><i class="fa-solid fa-question-circle mr-3 text-blue-600"></i>
                    FAQs</span></a></li>
              <li class="space-y-1">
                <button @click="expandedSubSubMenu = (expandedSubSubMenu === 'downloads' ? null : 'downloads')"
                  class="w-full text-left px-3 py-2 rounded hover:bg-yellow-100 flex justify-between items-center transition-colors duration-200">
                  <span class="flex items-center"><i class="fa-solid fa-file-download mr-3 text-orange-600"></i>
                    Downloads/Forms</span>
                  <svg :class="{ 'rotate-180': expandedSubSubMenu === 'downloads' }"
                    class="w-5 h-5 transition-transform" viewBox="0 0 12 12">
                    <path
                      d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
                  </svg>
                </button>
                <ul x-show="expandedSubSubMenu === 'downloads'" x-transition.opacity.duration.200ms class=" pl-4
                  space-y-1">
                  <li><a href="<?= site_url('resources/downloads/membership-application') ?>"
                      class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                        class="flex items-center"><i class="fa-solid fa-id-card mr-3 text-lime-600"></i> Membership
                        Application</span></a></li>
                  <li><a href="<?= site_url('resources/downloads/loan-application') ?>"
                      class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                        class="flex items-center"><i class="fa-solid fa-money-bill-wave mr-3 text-teal-600"></i> Loan
                        Application Forms</span></a></li>
                  <li><a href="<?= site_url('resources/downloads/savings-opening') ?>"
                      class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                        class="flex items-center"><i class="fa-solid fa-wallet mr-3 text-cyan-600"></i> Savings Account
                        Opening</span></a></li>
                  <li><a href="<?= site_url('resources/downloads/withdrawal-forms') ?>"
                      class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                        class="flex items-center"><i class="fa-solid fa-file-export mr-3 text-indigo-600"></i>
                        Withdrawal Forms</span></a></li>
                  <li><a href="<?= site_url('resources/downloads/kyc-checklist') ?>"
                      class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                        class="flex items-center"><i class="fa-solid fa-clipboard-check mr-3 text-pink-600"></i> KYC
                        Documents Checklist</span></a></li>
                </ul>
              </li>
            </ul>
          </li>

          <li class="space-y-1">
            <button
              @click="expandedSubMenu = (expandedSubMenu === 'policies' ? null : 'policies'); expandedSubSubMenu = null;"
              class="w-full text-left px-3 py-2 rounded hover:bg-yellow-100 flex justify-between items-center transition-colors duration-200">
              <span class="flex items-center"><i class="fa-solid fa-gavel mr-3 text-yellow-600"></i> Policies &
                Legal</span>
              <svg :class="{ 'rotate-180': expandedSubMenu === 'policies' }" class="w-5 h-5 transition-transform"
                viewBox="0 0 12 12">
                <path d=" M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0
                10-1.414-1.414z" />
              </svg>
            </button>
            <ul x-show="expandedSubMenu === 'policies'" x-transition.opacity.duration.200ms class="pl-4 space-y-1">
              <li><a href="<?= site_url('resources/policies/privacy-policy') ?>"
                  class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                    class="flex items-center"><i class="fa-solid fa-shield-alt mr-3 text-blue-600"></i> Privacy
                    Policy</span></a></li>
              <li><a href="<?= site_url('resources/policies/terms-conditions') ?>"
                  class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                    class="flex items-center"><i class="fa-solid fa-file-contract mr-3 text-red-600"></i> Terms &
                    Conditions</span></a></li>
              <li><a href="<?= site_url('resources/policies/loan-policy') ?>"
                  class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                    class="flex items-center"><i class="fa-solid fa-handshake mr-3 text-green-600"></i> Loan
                    Policy</span></a></li>
              <li><a href="<?= site_url('resources/policies/savings-policy') ?>"
                  class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                    class="flex items-center"><i class="fa-solid fa-money-bill-transfer mr-3 text-purple-600"></i>
                    Savings Policy</span></a></li>
              <li><a href="<?= site_url('resources/policies/complaint-resolution') ?>"
                  class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                    class="flex items-center"><i class="fa-solid fa-wrench mr-3 text-orange-600"></i> Complaint
                    Resolution</span></a></li>
            </ul>
          </li>
          <li><a href="<?= site_url('resources/articles') ?>"
              class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                class="flex items-center"><i class="fa-solid fa-newspaper mr-3 text-purple-600"></i> News &
                Articles</span></a></li>
          <li><a href="<?= site_url('resources/testimonials') ?>"
              class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                class="flex items-center"><i class="fa-solid fa-quote-right mr-3 text-cyan-600"></i>
                Testimonials</span></a></li>
        </ul>
      </li>

      <li class="space-y-1">
        <button @click=" expandedMenu=(expandedMenu==='about' ? null : 'about' ); expandedSubMenu=null;
        expandedSubSubMenu=null;"
          class="w-full text-left px-3 py-2 rounded hover:bg-yellow-100 flex justify-between items-center transition-colors duration-200">
          <span class="flex items-center">
            About Us
          </span>
          <svg :class="{ 'rotate-180': expandedMenu === 'about' }" class="w-5 h-5 transition-transform"
            viewBox="0 0 12 12">
            <path
              d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
          </svg>
        </button>
        <ul x-show="expandedMenu === 'about'" x-transition.opacity.duration.200ms class="pl-4 space-y-1">
          <li><a href="<?= site_url('about/our-story') ?>"
              class=" block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                class="flex items-center"><i class="fa-solid fa-book-open mr-3 text-indigo-500"></i> Our
                Story</span></a>
          </li>
          <li><a href="<?= site_url('about/mission-vision') ?>"
              class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                class="flex items-center"><i class="fa-solid fa-bullseye mr-3 text-green-500"></i> Mission &
                Values</span></a></li>
          <li class="space-y-1">
            <button @click=" expandedSubMenu=(expandedSubMenu==='our-team' ? null : 'our-team' );
            expandedSubSubMenu=null;"
              class="w-full text-left px-3 py-2 rounded hover:bg-yellow-100 flex justify-between items-center transition-colors duration-200">
              <span class="flex items-center"><i class="fa-solid fa-users mr-3 text-blue-500"></i> Our Team</span>
              <svg :class="{ 'rotate-180': expandedSubMenu === 'our-team' }" class="w-5 h-5 transition-transform"
                viewBox="0 0 12 12">
                <path
                  d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
              </svg>
            </button>
            <ul x-show="expandedSubMenu === 'our-team'" x-transition.opacity.duration.200ms class="pl-4 space-y-1">
              <li><a href="<?= site_url('about/leadership') ?>"
                  class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                    class="flex items-center"><i class="fa-solid fa-chess-queen mr-3 text-purple-500"></i> Leadership
                    Team</span></a></li>
              <li><a href="<?= site_url('about/board-members') ?>"
                  class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                    class="flex items-center"><i class="fa-solid fa-landmark mr-3 text-teal-500"></i> Board
                    Members</span></a></li>
              <li><a href="<?= site_url('about/management') ?>"
                  class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                    class="flex items-center"><i class="fa-solid fa-briefcase mr-3 text-orange-500"></i>
                    Management</span></a></li>
            </ul>
          </li>
          <li><a href="<?= site_url('about/careers') ?>"
              class=" block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                class="flex items-center"><i class="fa-solid fa-briefcase-medical mr-3 text-red-500"></i>
                Careers</span></a></li>
          <li><a href="<?= site_url('about/partnerships') ?>"
              class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                class="flex items-center"><i class="fa-solid fa-handshake-angle mr-3 text-yellow-500"></i>
                Partnership</span></a></li>
          <li><a href="<?= site_url('about/contact') ?>"
              class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
                class="flex items-center"><i class="fa-solid fa-envelope mr-3 text-pink-500"></i> Contact Us</span></a>
          </li>
        </ul>
      </li>

      <li><a href="#" @click.prevent="open('login')"
          class="block px-3 py-2 rounded hover:bg-yellow-100 transition-colors duration-200"><span
            class="flex items-center"><i class="fa-solid fa-sign-in-alt mr-3 text-gray-700"></i> Sign in</span></a></li>
      <li><a href="#" @click.prevent="open('signup')"
          class="block text-center px-4 py-2 mt-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition-colors duration-200">
          Join LTWCE
        </a></li>
    </ul>
  </nav>
</header>