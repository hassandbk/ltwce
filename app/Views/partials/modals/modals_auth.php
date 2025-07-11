<!-- BACKDROP -->
<!-- This is the backdrop that appears when the modal is visible. It dims the background. -->
<div x-show="modal" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 z-40"></div>

<!-- LOGIN MODAL -->
<template x-if="modal === 'login'">
  <div x-transition class="fixed inset-0 flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-5xl w-full grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
      <!-- Left: Login Form -->
      <div class="p-8">
        <h2 class="font-dm-serif text-3xl font-bold text-slate-800 mb-6 text-center">
          Sign in to LTWCE
        </h2>

        <!-- Social Login -->
        <div class="space-y-4 mb-6">
          <button @click="social('google')"
            class="w-full flex items-center justify-center space-x-3 bg-white border border-slate-200 rounded px-4 py-2 hover:shadow">
            <img src="<?= base_url('assets/images/google.svg'); ?>" alt="Google" class="w-8 h-8" />
            <span class="text-sm font-medium">Login with Google</span>
          </button>

          <button @click="social('facebook')"
            class="w-full flex items-center justify-center space-x-3 bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700">
            <img src="<?= base_url('assets/images/facebook.svg'); ?>" alt="Facebook" class="w-10 h-10" />
            <span class="text-sm font-medium">Login with Facebook</span>
          </button>
        </div>

        <div class="flex items-center my-6">
          <div class="flex-1 h-px bg-slate-200"></div>
          <span class="mx-3 text-sm text-slate-500">or</span>
          <div class="flex-1 h-px bg-slate-200"></div>
        </div>

        <!-- Login Form -->
        <form @submit.prevent="doLogin()" class="space-y-6">
          <div>
            <label class="block text-sm font-medium mb-1">Email <span class="text-rose-500">*</span></label>
            <input type="email" x-model="login.email" required
              class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded focus:bg-white focus:ring-yellow-500 focus:border-yellow-500 transition" />
          </div>

          <div>
            <label class="block text-sm font-medium mb-1">Password <span class="text-rose-500">*</span></label>
            <div class="relative">
              <input :type="showPwd ? 'text' : 'password'" x-model="login.password" required
                class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded focus:bg-white focus:ring-yellow-500 focus:border-yellow-500 transition" />
              <button type="button" @click="showPwd = !showPwd"
                class="absolute inset-y-0 right-2 flex items-center text-gray-500">
                <template x-show="showPwd">🙈</template>
                <template x-show="!showPwd">👁️</template>
              </button>
            </div>
          </div>

          <button type="submit" :disabled="loading"
            class="w-full bg-yellow-600 text-white py-2 rounded hover:bg-yellow-700 disabled:opacity-50 flex justify-center">
            <svg x-show="loading" class="w-5 h-5 mr-2 animate-spin" viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" />
            </svg>
            Sign In
          </button>

          <!-- Forgot password link -->
          <p class="text-center text-sm">
            <a href="#" @click.prevent="open('forgotEmail')" class="text-yellow-600 hover:underline">
              Forgot your password?
            </a>
          </p>
        </form>

        <p class="mt-4 text-center text-sm">
          Don’t have an account?
          <a href="#" @click.prevent="open('signup')" class="text-green-600 hover:underline">Sign Up</a>
        </p>
      </div>

      <!-- Right: Testimonial -->
      <div class="relative hidden lg:block">
        <div class="absolute inset-0">
          <img class="w-full h-full object-cover opacity-10" src="<?= base_url('assets/images/sign-in-bg.jpg'); ?>"
            alt="" />
        </div>
        <div class="relative z-10 flex items-center justify-center h-full p-8">
          <div class="bg-white bg-opacity-80 p-8 rounded-xl shadow-xl">
            <h3 class="font-dm-serif text-3xl font-bold mb-4 text-center text-slate-900">The Wealth Inc.</h3>
            <blockquote class="text-slate-700 italic mb-6 flex items-start space-x-4">
              <svg class="w-5 h-4 text-yellow-600" viewBox="0 0 20 16">
                <path
                  d="M15.722 4.008C14.408 1.214 10.954-.635 7.318.203 5.6.596 4.072 1.561 2.919 2.757A10.57 10.57 0 0 0 .484 6.93C.03 8.458-.173 10.035.18 11.764c.191.862.518 1.683 1.146 2.479a4.876 4.876 0 0 0 2.256 1.522c1.635.469 3.156.192 4.41-.439 1.242-.615 2.298-1.769 2.494-3.094.094-.656-.537-.657-.69-.18-.781 2.126-3.715 2.534-5.265 1.579-1.568-.922-1.185-3.068-.294-4.801.89-1.729 2.454-3.02 3.92-3.338.376-.098.714-.121 1.026-.098.324.018.658.074.98.188.65.2 1.23.591 1.618 1 .27.3.575.386 1.002.461.436.061.95.117 1.499.045.535-.073 1.06-.287 1.41-.807.345-.504.462-1.348.03-2.273" />
              </svg>
              <p>“Joining LTWCE doubled our productivity overnight.”</p>
            </blockquote>
            <div class="flex items-center">
              <img class="w-12 h-12 rounded-full mr-4" src="<?= base_url('assets/images/customer-avatar-05.jpg'); ?>"
                alt="Michael" />
              <div>
                <p class="text-sm font-medium text-slate-800">Michael Hassan</p>
                <p class="text-sm text-slate-500">CEO, The Wealth Inc.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Close button -->
      <button @click="close()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-2">✕</button>
    </div>
  </div>
</template>

<!-- SIGNUP MODAL -->
<template x-if="modal === 'signup'">
  <div x-transition class="fixed inset-0 flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-5xl w-full grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
      <!-- Left: Sign Up Form -->
      <div class="p-8">
        <h2 class="font-dm-serif text-3xl font-bold text-slate-800 mb-6 text-center">Create Your Account</h2>

        <!-- Social Sign Up -->
        <div class="space-y-4 mb-6">
          <button @click="social('google')"
            class="w-full flex items-center justify-center space-x-3 bg-white border border-slate-200 rounded px-4 py-2 hover:shadow">
            <img src="<?= base_url('assets/images/google.svg'); ?>" alt="Google logo" class="w-8 h-8" />
            <span class="text-sm font-medium">Sign up with Google</span>
          </button>

          <button @click="social('facebook')"
            class="w-full flex items-center justify-center space-x-3 bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700">
            <img src="<?= base_url('assets/images/facebook.svg'); ?>" alt="Facebook logo" class="w-10 h-10" />
            <span class="text-sm font-medium">Sign up with Facebook</span>
          </button>
        </div>

        <div class="flex items-center my-6">
          <div class="flex-1 h-px bg-slate-200"></div>
          <span class="mx-3 text-sm text-slate-500">or</span>
          <div class="flex-1 h-px bg-slate-200"></div>
        </div>

        <!-- Sign Up Form -->
        <form @submit.prevent="doSignup()" class="space-y-6">
          <div>
            <label class="block text-sm font-medium mb-1">Full Name <span class="text-rose-500">*</span></label>
            <input type="text" x-model="signup.name" required
              class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded focus:bg-white focus:ring-green-500 focus:border-green-500 transition" />
          </div>

          <div>
            <label class="block text-sm font-medium mb-1">Email <span class="text-rose-500">*</span></label>
            <input type="email" x-model="signup.email" required
              class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded focus:bg-white focus:ring-green-500 focus:border-green-500 transition" />
          </div>

          <div>
            <label class="block text-sm font-medium mb-1">Password <span class="text-rose-500">*</span></label>
            <div class="relative">
              <input :type="showPwd2 ? 'text' : 'password'" x-model="signup.password"
                @input="checkStrength(signup.password, 'signup')" required
                class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded focus:bg-white focus:ring-green-500 focus:border-green-500 transition" />
              <button type="button" @click="showPwd2 = !showPwd2"
                class="absolute inset-y-0 right-2 flex items-center text-gray-500">
                <template x-show="showPwd2">🙈</template>
                <template x-show="!showPwd2">👁️</template>
              </button>
            </div>
            <div class="w-full bg-gray-200 h-2 rounded mt-2">
              <div :class="strengthBar(signupStrength).bg" :style="`width:${signupStrength}%`" class="h-2 rounded">
              </div>
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium mb-1">Confirm Password <span class="text-rose-500">*</span></label>
            <input :type="showPwd2 ? 'text' : 'password'" x-model="signup.confirm" required
              class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded focus:bg-white focus:ring-green-500 focus:border-green-500 transition" />
          </div>

          <button type="submit" :disabled="loading"
            class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 disabled:opacity-50 flex justify-center">
            <svg x-show="loading" class="w-5 h-5 mr-2 animate-spin" viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" />
            </svg>
            Sign Up
          </button>
        </form>

        <p class="mt-4 text-center text-sm">
          Already have an account?
          <a href="#" @click.prevent="open('login')" class="text-yellow-600 hover:underline">Sign in</a>
        </p>
      </div>

      <!-- Right: Testimonial -->
      <div class="relative hidden lg:block">
        <div class="absolute inset-0">
          <img class="w-full h-full object-cover opacity-10"
            src="<?= base_url('assets/images/customer-avatar-05.jpg'); ?>" alt="" />
        </div>
        <div class="relative z-10 flex items-center justify-center h-full p-8">
          <div class="bg-white bg-opacity-80 p-8 rounded-xl shadow-xl">
            <h3 class="font-dm-serif text-3xl font-bold mb-4 text-center text-slate-900">Join The Wealth Inc.</h3>
            <blockquote class="text-slate-700 italic mb-6 flex items-start space-x-4">
              <svg class="w-5 h-4 text-yellow-600" viewBox="0 0 20 16">
                <path
                  d="M15.722 4.008C14.408 1.214 10.954-.635 7.318.203 5.6.596 4.072 1.561 2.919 2.757A10.57 10.57 0 0 0 .484 6.93C.03 8.458-.173 10.035.18 11.764c.191.862.518 1.683 1.146 2.479a4.876 4.876 0 0 0 2.256 1.522c1.635.469 3.156.192 4.41-.439 1.242-.615 2.298-1.769 2.494-3.094.094-.656-.537-.657-.69-.18-.781 2.126-3.715 2.534-5.265 1.579-1.568-.922-1.185-3.068-.294-4.801.89-1.729 2.454-3.02 3.92-3.338.376-.098.714-.121 1.026-.098.324.018.658.074.98.188.65.2 1.23.591 1.618 1 .27.3.575.386 1.002.461.436.061.95.117 1.499.045.535-.073 1.06-.287 1.41-.807.345-.504.462-1.348.03-2.273" />
              </svg>
              <p>“LTWCE transformed our business within days.”</p>
            </blockquote>
            <div class="flex items-center">
              <img class="w-12 h-12 rounded-full mr-4" src="<?= base_url('assets/images/customer-avatar-02.jpg'); ?>"
                alt="Anna" />
              <div>
                <p class="text-sm font-medium text-slate-800">Anna Smith</p>
                <p class="text-sm text-slate-500">CTO, The Wealth Inc.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Close button -->
      <button @click="close()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-2">✕</button>
    </div>
  </div>
</template>

<!-- FORGOT PASSWORD: ENTER EMAIL -->
<template x-if="modal==='forgotEmail'">
  <div x-transition class="fixed inset-0 flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-8 relative">
      <h2 class="font-dm-serif text-2xl font-bold mb-4 text-center">
        Reset Password
      </h2>
      <form @submit.prevent="sendResetOTP()" class="space-y-6">
        <div>
          <label class="block text-sm font-medium mb-1">Email <span class="text-rose-500">*</span></label>
          <input type="email" x-model="forgot.email" required
            class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded focus:bg-white focus:ring-yellow-500 focus:border-yellow-500 transition" />
        </div>
        <button type="submit" :disabled="loading"
          class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600 disabled:opacity-50 flex justify-center">
          <svg x-show="loading" class="w-5 h-5 mr-2 animate-spin" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" />
          </svg>
          Send Code
        </button>
      </form>
      <button @click="close()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-2">
        ✕
      </button>
    </div>
  </div>
</template>
<!-- FORGOT PASSWORD: VERIFY CODE -->
<template x-if="modal==='forgotOTP'">
  <div x-transition class="fixed inset-0 flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-8 relative">
      <h2 class="font-dm-serif text-2xl font-bold mb-4 text-center">
        Enter Verification Code
      </h2>
      <form @submit.prevent="verifyResetOTP(forgot.code.join(''))" class="space-y-6">
        <div>
          <label class="block text-sm font-medium mb-1">
            6‑digit Code <span class="text-rose-500">*</span>
          </label>
          <div class="flex justify-between space-x-2">
            <template x-for="(digit, i) in forgot.code" :key="i">
              <input type="text" maxlength="1" pattern="[0-9]*" inputmode="numeric" x-model="forgot.code[i]" @input="
                  if ($event.target.value.length > 0 && i < 5) {
                    $event.target.nextElementSibling.focus()
                  }
                " @keydown.backspace="
                  if (!$event.target.value && i > 0) {
                    $event.target.previousElementSibling.focus()
                  }
                "
                class="w-12 h-12 text-center text-lg bg-gray-50 border border-gray-300 rounded focus:bg-white focus:ring-yellow-500 focus:border-yellow-500 transition" />
            </template>
          </div>
        </div>
        <button type="submit" :disabled="loading"
          class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600 disabled:opacity-50 flex justify-center">
          <svg x-show="loading" class="w-5 h-5 mr-2 animate-spin" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" />
          </svg>
          Verify Code
        </button>
      </form>
      <p class="mt-4 text-center text-sm">
        <button @click="sendResetOTP()" class="text-yellow-600 hover:underline" :disabled="otpTimer > 0">
          <template x-if="otpTimer > 0">
            Resend in <span x-text="otpTimer + 's'"></span>
          </template>
          <template x-if="otpTimer === 0">Resend Code</template>
        </button>
      </p>
      <button @click="close()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-2">
        ✕
      </button>
    </div>
  </div>

</template>

<!-- RESET PASSWORD: NEW PASSWORD -->
<template x-if="modal==='resetPass'">
  <div x-transition class="fixed inset-0 flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-8 relative">
      <h2 class="font-dm-serif text-2xl font-bold mb-4 text-center">
        Choose a New Password
      </h2>
      <form @submit.prevent="doResetPass()" class="space-y-6">
        <div>
          <label class="block text-sm font-medium mb-1">New Password <span class="text-rose-500">*</span></label>
          <div class="relative">
            <input :type="showPwd3?'text':'password'" x-model="reset.password"
              @input="checkStrength(reset.password,'reset')" required
              class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded focus:bg-white focus:ring-purple-500 focus:border-purple-500 transition" />
            <button type="button" @click="showPwd3=!showPwd3"
              class="absolute inset-y-0 right-2 flex items-center text-gray-500">
              <template x-show="showPwd3">🙈</template>
              <template x-show="!showPwd3">👁️</template>
            </button>
          </div>
          <div class="w-full bg-gray-200 h-2 rounded mt-2">
            <div :class="strengthBar(resetStrength).bg" :style="`width:${resetStrength}%`" class="h-2 rounded"></div>
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Confirm Password <span class="text-rose-500">*</span></label>
          <input :type="showPwd3?'text':'password'" x-model="reset.confirm" required
            class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded focus:bg-white focus:ring-purple-500 focus:border-purple-500 transition" />
        </div>
        <button type="submit" :disabled="loading"
          class="w-full bg-purple-600 text-white py-2 rounded hover:bg-purple-700 disabled:opacity-50 flex justify-center">
          <svg x-show="loading" class="w-5 h-5 mr-2 animate-spin" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" />
          </svg>
          Update Password
        </button>
      </form>
      <button @click="close()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-2">
        ✕
      </button>
    </div>
  </div>
</template>