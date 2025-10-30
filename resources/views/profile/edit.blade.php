<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Profile Header -->
            <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-2xl shadow-xl p-8 mb-8 text-white">
                <div class="flex items-center space-x-6">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center text-blue-600 font-extrabold text-3xl shadow-lg">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h1 class="text-3xl font-extrabold mb-1">{{ Auth::user()->name }}</h1>
                        <p class="text-blue-100 text-lg">{{ Auth::user()->email }}</p>
                        <span class="inline-flex items-center mt-2 px-3 py-1 rounded-full text-xs font-semibold bg-white/20 backdrop-blur-md">
                            <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <!-- Profile Information Card -->
                <div class="bg-white shadow-lg rounded-2xl border border-blue-100 overflow-hidden">
                    <div class="px-8 py-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100">
                        <div class="flex items-center space-x-3">
                            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Informasi Profil</h3>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Perbarui informasi profil dan alamat email akun Anda.</p>
                    </div>
                    <div class="p-8">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Password Card -->
                <div class="bg-white shadow-lg rounded-2xl border border-yellow-100 overflow-hidden">
                    <div class="px-8 py-6 bg-gradient-to-r from-yellow-50 to-orange-50 border-b border-yellow-100">
                        <div class="flex items-center space-x-3">
                            <div class="bg-gradient-to-r from-yellow-600 to-orange-600 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Ubah Kata Sandi</h3>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Pastikan menggunakan kata sandi yang panjang dan aman.</p>
                    </div>
                    <div class="p-8">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Delete Account Card -->
            <div class="bg-white shadow-lg rounded-2xl border border-red-100 overflow-hidden">
                <div class="px-8 py-6 bg-gradient-to-r from-red-50 to-rose-50 border-b border-red-100">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gradient-to-r from-red-600 to-rose-600 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Hapus Akun</h3>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">Hapus akun Anda secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="p-8">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
