<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black">
    <div class="min-h-screen py-10 px-5">
        <div class="max-w-4xl mx-auto bg-gray-900 shadow-lg rounded-lg p-6">
            <h1 class="text-2xl font-bold text-white mb-6 text-center">Konfirmasi Transaksi</h1>
            <div class="border-b border-gray-600 pb-4 mb-4">
                <h2 class="text-lg font-semibold text-gray-300">Detail Barang yang Dibeli</h2>
            </div>
            <table class="w-full text-sm text-left text-gray-300">
                <thead class="text-xs text-gray-400 uppercase bg-gray-700">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama Barang</th>
                        <th class="px-4 py-2">Jumlah</th>
                        <th class="px-4 py-2">Harga Satuan</th>
                        <th class="px-4 py-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-gray-700 border-b border-gray-600 hover:bg-gray-600">
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2">Beras 5kg</td>
                        <td class="px-4 py-2">2</td>
                        <td class="px-4 py-2">Rp 65,000</td>
                        <td class="px-4 py-2">Rp 130,000</td>
                    </tr>
                    <tr class="bg-gray-700 border-b border-gray-600 hover:bg-gray-600">
                        <td class="px-4 py-2">2</td>
                        <td class="px-4 py-2">Minyak Goreng 2L</td>
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2">Rp 50,000</td>
                        <td class="px-4 py-2">Rp 50,000</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-6 border-t border-gray-600 pt-4">
                <div class="flex justify-between text-gray-300">
                    <span>Subtotal</span>
                    <span>Rp 180,000</span>
                </div>
                <div class="flex justify-between text-gray-300 mt-2">
                    <span>Pajak (10%)</span>
                    <span>Rp 18,000</span>
                </div>
                <div class="flex justify-between font-bold text-white text-lg mt-4">
                    <span>Total</span>
                    <span>Rp 198,000</span>
                </div>
            </div>

            <div class="mt-6 text-center">
                <h3 class="text-gray-300">Terima kasih telah berbelanja di <span class="font-semibold text-white">E-Kelontong!</span></h3>
                <p class="text-sm text-gray-400 mt-2">Barang pesanan Anda akan segera diproses.</p>
            </div>

            <div class="mt-8 flex justify-center">
                <a href="/" class="px-6 py-3 text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition duration-300">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>
