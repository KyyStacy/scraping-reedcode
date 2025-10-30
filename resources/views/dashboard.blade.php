<x-app-layout>
    @php
        $shopCount = App\Models\Shop::count();
        $twoMinutesAgo = Carbon\Carbon::now()->subMinutes(2);
        $onlineEmployees = App\Models\User::where('last_seen', '>=', $twoMinutesAgo)->get();
        $onlineEmployeesCount = $onlineEmployees->count();
    @endphp

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-2xl shadow-xl p-8 mb-8 text-white">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-6 md:mb-0">
                        <h1 class="text-3xl font-extrabold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-blue-100 text-lg">Kelola dan bandingkan produk dari 2 toko Tokopedia dengan mudah</p>
                    </div>
                    <div class="flex items-center space-x-2 bg-white/20 backdrop-blur-md px-4 py-2 rounded-full">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        <span class="font-semibold">Reed Code Product</span>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid md:grid-cols-2 gap-6 mb-8">
                <!-- Shop Count Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-blue-100 transition duration-300 hover:shadow-2xl hover:scale-105 group">
                    <div class="p-8 flex items-center justify-between">
                        <div>
                            <div class="flex items-center space-x-2 mb-2">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Jumlah Toko</h2>
                            </div>
                            <p class="text-5xl font-extrabold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">{{ number_format($shopCount) }}</p>
                            <p class="text-sm text-gray-500 mt-2">Total toko terdaftar</p>
                        </div>
                        <div class="bg-gradient-to-br from-blue-100 to-indigo-100 p-4 rounded-2xl group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Online Users Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-green-100 transition duration-300 hover:shadow-2xl hover:scale-105 group">
                    <div class="p-8 flex items-center justify-between">
                        <div>
                            <div class="flex items-center space-x-2 mb-2">
                                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Pengguna Online</h2>
                            </div>
                            <p id="online-employees-count" class="text-5xl font-extrabold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">{{ $onlineEmployeesCount }}</p>
                            <p class="text-sm text-gray-500 mt-2">Aktif sekarang</p>
                        </div>
                        <div class="bg-gradient-to-br from-green-100 to-emerald-100 p-4 rounded-2xl group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Online Users Table -->
            <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-200">
                <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-blue-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Pengguna Online</h2>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                            {{ $onlineEmployeesCount }} Aktif
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">
                                        Peran
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-blue-700 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="users-table-body" class="bg-white divide-y divide-gray-100">
                                @foreach($onlineEmployees as $employee)
                                    <tr class="hover:bg-blue-50 transition duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-12 w-12">
                                                    <div class="h-12 w-12 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                                        {{ strtoupper(substr($employee->name, 0, 1)) }}
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-semibold text-gray-900">
                                                        {{ $employee->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-700">{{ $employee->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                {{ ucfirst($employee->role) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                                                Online
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function fetchUserStatuses() {
            fetch('{{ route("users.statuses") }}')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('users-table-body');
                    tableBody.innerHTML = '';
                    let onlineCount = 0;
                    data.forEach(user => {
                        if (user.is_online) {
                            onlineCount++;
                            const row = document.createElement('tr');
                            row.id = `user-${user.id}`;
                            row.className = 'hover:bg-blue-50 transition duration-200';

                            const userRole = capitalizeFirstLetter(user.role);

                            row.innerHTML = `
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            <div class="h-12 w-12 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                                ${user.name.charAt(0).toUpperCase()}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">${user.name}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-700">${user.email}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                        ${userRole}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                                        Online
                                    </span>
                                </td>
                            `;

                            tableBody.appendChild(row);
                        }
                    });
                    document.getElementById('online-employees-count').textContent = onlineCount;
                });
        }

        setInterval(fetchUserStatuses, 5000); // Polling setiap 5 detik
    </script>
</x-app-layout>