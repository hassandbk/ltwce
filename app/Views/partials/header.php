<header
        class="fixed w-full z-30 bg-slate-900 text-white"
        x-data="{ mobileOpen: false }"
      >
        <div
          class="max-w-6xl mx-auto px-5 sm:px-6 flex items-center justify-between py-4"
        >
          <!-- Left: Logo + Desktop Nav -->
          <div class="flex items-center space-x-8">
            <!-- Logo -->
            <a href="index.html" class="flex items-center space-x-3">
              <img src="<?= base_url('assets/images/logo.png'); ?>" alt="Logo" width="40" height="40" />
              <span class="font-playfair text-2xl">LTWCE SACCO</span>
            </a>
            <!-- Desktop nav -->
            <nav class="hidden md:flex items-center space-x-6">
              <a
                href="about.html"
                class="text-base font-medium hover:text-yellow-500"
                >About</a
              >
              <a
                href="services.html"
                class="text-base font-medium hover:text-yellow-500"
                >Services</a
              >
              <a
                href="blog.html"
                class="text-base font-medium hover:text-yellow-500"
                >Blog</a
              >
              <a
                href="wall-of-love.html"
                class="text-base font-medium hover:text-yellow-500"
                >Wall of Love</a
              >

              <!-- Resources dropdown -->
              <div
                x-data="{ open: false, timeout: null }"
                @mouseenter="clearTimeout(timeout); open = true"
                @mouseleave="timeout = setTimeout(() => open = false, 300)"
                class="relative"
              >
                <button
                  @click="open = !open"
                  :aria-expanded="open"
                  aria-haspopup="true"
                  class="flex items-center text-base font-medium hover:text-yellow-500 focus:outline-none"
                >
                  Resources
                  <svg class="ml-1 w-4 h-4 fill-current" viewBox="0 0 12 12">
                    <path
                      d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z"
                    />
                  </svg>
                </button>
                <ul
                  x-show="open"
                  x-cloak
                  x-transition.opacity.duration.200ms
                  @mouseenter="clearTimeout(timeout)"
                  @mouseleave="timeout = setTimeout(() => open = false, 300)"
                  class="absolute left-0 mt-2 w-40 bg-white text-slate-800 rounded shadow-lg py-2"
                >
                  <li>
                    <a
                      href="404.html"
                      class="block px-4 py-2 text-sm hover:bg-yellow-100"
                    >
                      404
                    </a>
                  </li>
                  <li>
                    <a
                      href="support.html"
                      class="block px-4 py-2 text-sm hover:bg-yellow-100"
                    >
                      Support
                    </a>
                  </li>
                </ul>
              </div>
            </nav>
          </div>

          <!-- Right: Sign in & CTA -->
          <div class="hidden md:flex items-center space-x-6">
            <a
              href="#"
              @click.prevent="open('login')"
              class="text-base font-medium hover:text-yellow-500"
              >Sign in</a
            >
            <a
              href="#"
              @click.prevent="open('signup')"
              class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600"
            >
              Join LTWCE <span class="ml-2">→</span>
            </a>
          </div>

          <!-- Mobile menu button -->
          <button
            @click="mobileOpen = !mobileOpen"
            aria-label="Toggle mobile menu"
            :aria-expanded="mobileOpen"
            class="md:hidden p-2 text-white hover:text-yellow-200 focus:outline-none"
          >
            <svg
              class="w-6 h-6"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
            </svg>
          </button>
        </div>

        <!-- Mobile nav panel -->
        <nav
          id="mobile-nav"
          x-show="mobileOpen"
          x-cloak
          @click.away="mobileOpen = false"
          @keydown.escape.window="mobileOpen = false"
          x-transition
          class="md:hidden bg-white text-slate-800 border-t border-slate-200 shadow-lg"
        >
          <ul class="space-y-1 p-4">
            <li>
              <a
                href="about.html"
                class="block px-3 py-2 rounded hover:bg-yellow-100"
              >
                About
              </a>
            </li>
            <li>
              <a
                href="services.html"
                class="block px-3 py-2 rounded hover:bg-yellow-100"
              >
                services
              </a>
            </li>
            <li></li>
            <li>
              <a
                href="blog.html"
                class="block px-3 py-2 rounded hover:bg-yellow-100"
              >
                Blog
              </a>
            </li>
            <li>
              <a
                href="wall-of-love.html"
                class="block px-3 py-2 rounded hover:bg-yellow-100"
              >
                Wall of Love
              </a>
            </li>

            <!-- Mobile Resources -->
            <li x-data="{ open: false }" class="space-y-1">
              <button
                @click="open = !open"
                class="w-full text-left px-3 py-2 rounded hover:bg-yellow-100 flex justify-between items-center"
              >
                Resources
                <svg
                  :class="{ 'rotate-180': open }"
                  class="w-4 h-4 transition-transform"
                  viewBox="0 0 12 12"
                >
                  <path
                    d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z"
                  />
                </svg>
              </button>
              <ul x-show="open" class="pl-4 space-y-1">
                <li>
                  <a
                    href="404.html"
                    class="block px-3 py-2 rounded hover:bg-yellow-100"
                  >
                    404
                  </a>
                </li>
                <li>
                  <a
                    href="support.html"
                    class="block px-3 py-2 rounded hover:bg-yellow-100"
                  >
                    Support
                  </a>
                </li>
              </ul>
            </li>

            <li>
              <a
                href="#"
                @click.prevent="open('login')"
                class="block px-3 py-2 rounded hover:bg-yellow-100"
                >Sign in</a
              >
            </li>
            <li>
              <a
                href="#"
                @click.prevent="open('signup')"
                class="block text-center px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600"
                >Join LTWCE</a
              >
            </li>
          </ul>
        </nav>
      </header>