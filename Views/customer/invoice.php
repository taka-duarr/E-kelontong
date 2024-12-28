<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black">
    <div class="min-h-screen py-10 px-5">
        <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md  sm:justify-start">
            <h1 class="text-2xl font-bold text-black mb-6 text-center">Konfirmasi Transaksi</h1>
            <div class="border-b border-gray-300 pb-4 mb-4">
                <h2 class="text-lg font-semibold text-black">Detail Barang yang Dibeli</h2>
            </div>
            <table class="w-full text-sm text-left text-black">
                <thead class="text-xs text-white uppercase bg-black">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama Barang</th>
                        <th class="px-4 py-2">Jumlah</th>
                        <th class="px-4 py-2">Harga Satuan</th>
                        <th class="px-4 py-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-gray-50 border-b border-gray-200 hover:bg-gray-100">
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2">Beras 5kg</td>
                        <td class="px-4 py-2">2</td>
                        <td class="px-4 py-2">Rp 65,000</td>
                        <td class="px-4 py-2">Rp 130,000</td>
                    </tr>
                    <tr class="bg-gray-50 border-b border-gray-200 hover:bg-gray-100">
                        <td class="px-4 py-2">2</td>
                        <td class="px-4 py-2">Minyak Goreng 2L</td>
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2">Rp 50,000</td>
                        <td class="px-4 py-2">Rp 50,000</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-6 border-t border-gray-200 pt-4">
                <div class="flex justify-between text-black">
                    <span>Subtotal</span>
                    <span>Rp 180,000</span>
                </div>
                <div class="flex justify-between text-black mt-2">
                    <span>Pajak (10%)</span>
                    <span>Rp 18,000</span>
                </div>
                <div class="flex justify-between font-bold text-black text-lg mt-4">
                    <span>Total</span>
                    <span>Rp 198,000</span>
                </div>
                <div class="flex justify-between text-black mt-2">
                    <span>status </span>
                    
                </div>
            </div>

            <div class="mt-6 text-center">
                <h3 class="text-black">Terima kasih telah berbelanja di <span class="font-semibold">E-Kelontong!</span></h3>
                <p class="text-sm text-gray-600 mt-2">Barang pesanan Anda akan segera diproses.</p>
            </div>

            <div class="mt-8 flex justify-center">
                <a href="/" class="px-6 py-3 text-white bg-black rounded-lg hover:bg-gray-800 transition duration-300">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>
