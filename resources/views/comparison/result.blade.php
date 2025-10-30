<x-app-layout>
    <div class="py-8 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Card -->
            <div class="bg-white shadow-lg rounded-2xl border border-gray-200 overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <a href="{{ route('comparison.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-xl transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>
                        <div class="text-center">
                            <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Hasil Perbandingan
                            </h1>
                            <p class="text-sm text-gray-600 mt-1">Keyword: <strong>{{ request('keyword') }}</strong></p>
                        </div>
                        <form action="{{ route('comparison.compare') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="shop1_id" value="{{ $shop1->id }}">
                            <input type="hidden" name="shop2_id" value="{{ $shop2->id }}">
                            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                            <input type="hidden" name="page1" value="{{ $shop1_data['current_page'] }}">
                            <input type="hidden" name="page2" value="{{ $shop2_data['current_page'] }}">
                            <select name="sort" onchange="this.form.submit()" class="bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-200 text-sm font-medium">
                                <option value="23" {{ $current_sort == '23' ? 'selected' : '' }}>Relevan</option>
                                <option value="2" {{ $current_sort == '2' ? 'selected' : '' }}>Terbaru</option>
                                <option value="10" {{ $current_sort == '10' ? 'selected' : '' }}>Harga Tertinggi</option>
                                <option value="9" {{ $current_sort == '9' ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="11" {{ $current_sort == '11' ? 'selected' : '' }}>Ulasan Terbanyak</option>
                                <option value="8" {{ $current_sort == '8' ? 'selected' : '' }}>Pembelian Terbanyak</option>
                                <option value="5" {{ $current_sort == '5' ? 'selected' : '' }}>Dilihat Terbanyak</option>
                                <option value="3" {{ $current_sort == '3' ? 'selected' : '' }}>Pembaruan Terakhir</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Comparison Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach (['shop1_data', 'shop2_data'] as $index => $shop_data)
                    <div class="flex flex-col h-[calc(100vh-12rem)] bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <!-- Shop Header -->
                        <div class="px-6 py-4 bg-gradient-to-r {{ $index === 0 ? 'from-green-50 to-emerald-50' : 'from-orange-50 to-amber-50' }} border-b border-gray-200 relative h-24">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-r {{ $index === 0 ? 'from-green-600 to-emerald-600' : 'from-orange-600 to-amber-600' }} flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                        {{ strtoupper(substr(${$shop_data}['shop_name'], 0, 1)) }}
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-bold text-gray-900">{{ ${$shop_data}['shop_name'] }}</h2>
                                        <p class="text-sm text-gray-600 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                            {{ count(${$shop_data}['products']) }} produk
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Pagination Buttons -->
                            <div class="flex space-x-2 absolute right-6 top-1/2 -translate-y-1/2">
                                @if (${$shop_data}['prev_page'])
                                    <form action="{{ route('comparison.compare') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="shop1_id" value="{{ $shop1->id }}">
                                        <input type="hidden" name="shop2_id" value="{{ $shop2->id }}">
                                        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                                        <input type="hidden" name="{{ $index === 0 ? 'page1' : 'page2' }}" value="{{ ${$shop_data}['current_page'] - 1 }}">
                                        <input type="hidden" name="sort" value="{{ $current_sort }}">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r {{ $index === 0 ? 'from-green-600 to-emerald-600' : 'from-orange-600 to-amber-600' }} text-white font-semibold rounded-lg hover:shadow-lg transition duration-200 text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                            </svg>
                                            Sebelumnya
                                        </button>
                                    </form>
                                @endif
                                @if (${$shop_data}['next_page'])
                                    <form action="{{ route('comparison.compare') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="shop1_id" value="{{ $shop1->id }}">
                                        <input type="hidden" name="shop2_id" value="{{ $shop2->id }}">
                                        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                                        <input type="hidden" name="{{ $index === 0 ? 'page1' : 'page2' }}" value="{{ ${$shop_data}['current_page'] + 1 }}">
                                        <input type="hidden" name="sort" value="{{ $current_sort }}">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r {{ $index === 0 ? 'from-green-600 to-emerald-600' : 'from-orange-600 to-amber-600' }} text-white font-semibold rounded-lg hover:shadow-lg transition duration-200 text-sm">
                                            Selanjutnya
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <!-- Products Grid -->
                        <div class="flex-1 overflow-y-auto p-6 bg-gray-50">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @forelse (${$shop_data}['products'] as $product)
                                    <div class="bg-white rounded-xl shadow-md p-3 hover:shadow-xl transition-all duration-300 border border-gray-100">
                                        <div class="relative">
                                            <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" 
                                                 class="w-full h-32 object-contain rounded-lg mb-2 bg-white">
                                            <input type="radio" name="selected_product_{{ $index }}" 
                                                   value="{{ json_encode($product) }}" 
                                                   class="absolute top-2 right-2 h-5 w-5 text-blue-600 cursor-pointer focus:ring-2 focus:ring-blue-300 rounded-full"
                                                   onchange="handleProductSelection({{ $index }}, this.value)">
                                        </div>
                                        <a href="{{ $product['link'] }}" target="_blank" 
                                           class="text-blue-600 hover:text-blue-800 text-xs font-medium line-clamp-2 mb-2 block">
                                            {{ $product['title'] }}
                                        </a>
                                        <p class="text-base font-bold text-gray-900 mb-1">{{ $product['price'] }}</p>
                                        <div class="flex items-center justify-between text-xs">
                                            @if(isset($product['rating']))
                                                <div class="flex items-center text-gray-600">
                                                    <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                    </svg>
                                                    {{ $product['rating'] }}
                                                </div>
                                            @endif
                                            @if(isset($product['sold']))
                                                <span class="text-gray-500">{{ $product['sold'] }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-4 text-center py-12">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="text-gray-500 font-medium">Tidak ada produk ditemukan</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Popup Perbandingan -->
    <div id="comparison-popup" class="fixed bottom-0 right-4 transform transition-transform duration-300 translate-y-full">
        <!-- Header popup -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-t-2xl shadow-2xl p-4 cursor-pointer" onclick="togglePopup()">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span id="selected-count" class="bg-white text-blue-600 px-4 py-1.5 rounded-full text-sm font-bold shadow-md">0 produk dipilih</span>
                </div>
                <div id="popup-arrow" class="transform transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Konten popup -->
        <div id="popup-content" class="bg-white shadow-2xl w-[520px] rounded-b-2xl border-x-2 border-b-2 border-blue-100">
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div id="product1-details" class="space-y-3"></div>
                    <div id="product2-details" class="space-y-3"></div>
                </div>
                <div id="price-difference" class="mt-5 pt-5 border-t-2 border-gray-200"></div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk handling perbandingan -->
    <script>
        let selectedProducts = [null, null];
        const popup = document.getElementById('comparison-popup');
        const popupArrow = document.getElementById('popup-arrow');
        const selectedCount = document.getElementById('selected-count');
        let isPopupOpen = false;

        function handleProductSelection(index, productJson) {
            selectedProducts[index] = JSON.parse(productJson);
            updateSelectedCount();
            updateComparisonPopup();
        }

        function updateSelectedCount() {
            const count = selectedProducts.filter(p => p !== null).length;
            selectedCount.textContent = `${count} produk dipilih`;
        }

        function updateComparisonPopup() {
            if (selectedProducts[0] && selectedProducts[1]) {
                document.getElementById('product1-details').innerHTML = `
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 border-2 border-green-200 shadow-md">
                        <div class="mb-2 flex items-center justify-between">
                            <span class="text-xs font-bold text-green-700 bg-green-200 px-2 py-1 rounded-full">Toko 1</span>
                        </div>
                        <img src="${selectedProducts[0].image}" alt="${selectedProducts[0].title}" class="w-full h-32 object-contain mb-3 rounded-lg bg-white p-2">
                        <h4 class="font-semibold text-sm text-gray-900 mb-2 line-clamp-2">${selectedProducts[0].title}</h4>
                        <div class="flex items-center justify-between">
                            <span class="text-green-700 font-bold text-lg">${selectedProducts[0].price}</span>
                            <a href="${selectedProducts[0].link}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 text-xs font-medium">
                                Lihat
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>
                    </div>
                `;

                document.getElementById('product2-details').innerHTML = `
                    <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl p-4 border-2 border-orange-200 shadow-md">
                        <div class="mb-2 flex items-center justify-between">
                            <span class="text-xs font-bold text-orange-700 bg-orange-200 px-2 py-1 rounded-full">Toko 2</span>
                        </div>
                        <img src="${selectedProducts[1].image}" alt="${selectedProducts[1].title}" class="w-full h-32 object-contain mb-3 rounded-lg bg-white p-2">
                        <h4 class="font-semibold text-sm text-gray-900 mb-2 line-clamp-2">${selectedProducts[1].title}</h4>
                        <div class="flex items-center justify-between">
                            <span class="text-orange-700 font-bold text-lg">${selectedProducts[1].price}</span>
                            <a href="${selectedProducts[1].link}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 text-xs font-medium">
                                Lihat
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>
                    </div>
                `;

                const price1 = parseInt(selectedProducts[0].price.replace(/[^0-9]/g, ''));
                const price2 = parseInt(selectedProducts[1].price.replace(/[^0-9]/g, ''));
                const difference = Math.abs(price1 - price2);
                const percentage = ((difference / Math.max(price1, price2)) * 100).toFixed(1);
                const cheaperProduct = price1 > price2 ? 'Toko 2' : 'Toko 1';
                const cheaperColor = price1 > price2 ? 'orange' : 'green';

                document.getElementById('price-difference').innerHTML = `
                    <div class="space-y-3">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-semibold text-gray-700">Selisih Harga:</span>
                                <span class="font-bold text-blue-700 text-lg">Rp ${difference.toLocaleString('id-ID')}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-semibold text-gray-700">Persentase:</span>
                                <span class="font-bold text-blue-700 text-lg">${percentage}%</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="inline-flex items-center bg-gradient-to-r from-${cheaperColor}-100 to-${cheaperColor}-200 text-${cheaperColor}-800 text-sm font-bold px-6 py-3 rounded-full shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                ${cheaperProduct} Lebih Murah
                            </div>
                        </div>
                    </div>
                `;

                showPopup();
            }
        }

        function togglePopup() {
            isPopupOpen = !isPopupOpen;
            popup.style.transform = isPopupOpen ? 'translateY(0)' : 'translateY(calc(100% - 48px))';
            popupArrow.style.transform = isPopupOpen ? 'rotate(0deg)' : 'rotate(180deg)';
        }

        function showPopup() {
            if (!isPopupOpen) {
                togglePopup();
            }
        }

        // Inisialisasi posisi popup
        popup.style.transform = 'translateY(calc(100% - 48px))';
    </script>

    <style>
        #comparison-popup {
            z-index: 50;
            transition: transform 0.3s ease-in-out;
        }

        #popup-arrow {
            transition: transform 0.3s ease-in-out;
        }
    </style>
</x-app-layout>