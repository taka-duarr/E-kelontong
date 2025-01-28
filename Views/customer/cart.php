<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @layer utilities {
      input[type="number"]::-webkit-inner-spin-button,
      input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }
    }
  </style>
</head>
<body class="bg-gray-100">
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-center mb-6">Keranjang</h1>
    
    <div class="flex flex-col lg:flex-row gap-6">
      <!-- Cart Items -->
      <div class="w-full lg:w-2/3 space-y-4">
        <div class="overflow-x-auto">
          <div class="inline-block min-w-full">
            <div class="overflow-hidden">
              <?php 
              $total = 0;
              foreach ($Carts as $item) { 
                  $subtotal = $item['jumlah'] * $item['harga_barang'];
                  $total += $subtotal;
                  $_SESSION['total'] = $total;
              ?>
              <div class="bg-white rounded-lg shadow-md p-4 mb-4 flex items-center space-x-4">
                <img src="imgBarang/<?php echo htmlspecialchars($item['gambar_barang']); ?>" alt="product-image" class="w-20 h-20 object-cover rounded-lg flex-shrink-0" />
                <div class="flex-grow min-w-0">
                  <h2 class="text-sm font-bold text-gray-900 truncate"><?php echo htmlspecialchars($item['nama_barang']); ?></h2>
                  <p class="text-xs text-gray-600 mt-1">Rp <?php echo number_format($item['harga_barang']); ?></p>
                </div>
                <div class="flex items-center space-x-2">
                  <div class="flex items-center border border-gray-200 rounded">
                    <form action="index.php?modul=cart&fitur=update" method="POST" class="inline-block">
                      <input type="hidden" name="id_barang" value="<?php echo htmlspecialchars($item['id_barang']); ?>" />
                      <input type="hidden" name="jumlah" value="<?php echo $item['jumlah'] - 1; ?>" />
                      <button type="submit" class="btn btn-xs btn-ghost" <?php if ($item['jumlah'] <= 1) echo 'disabled'; ?>>-</button>
                    </form>
                    <input class="w-8 text-center bg-transparent text-xs" type="number" value="<?php echo htmlspecialchars($item['jumlah']); ?>" min="1" readonly />
                    <form action="index.php?modul=cart&fitur=update" method="POST" class="inline-block">
                      <input type="hidden" name="id_barang" value="<?php echo htmlspecialchars($item['id_barang']); ?>" />
                      <input type="hidden" name="jumlah" value="<?php echo $item['jumlah'] + 1; ?>" />
                      <button type="submit" class="btn btn-xs btn-ghost">+</button>
                    </form>
                  </div>
                  <a href="index.php?modul=cart&fitur=delete&id_cart=<?php echo $item['id_cart']; ?>" class="btn btn-xs btn-error">Delete</a>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Subtotal -->
      <div class="w-full lg:w-1/3">
        <div class="bg-white rounded-lg shadow-md p-6">
          <form method="POST" action="index.php?modul=transaksi&fitur=add">
            <div class="mb-4">
              <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat Pengiriman</label>
              <textarea id="alamat" name="alamat" rows="4" class="textarea textarea-bordered w-full" placeholder="Masukkan alamat lengkap Anda" required></textarea>
            </div>
            <input type="hidden" name="id_user" value="<?= $_SESSION['user']['id'] ?>">
            <div class="flex justify-between items-center mb-4">
              <p class="text-lg font-bold">Total</p>
              <p class="text-lg font-bold">Rp <?php echo number_format($total); ?></p>
            </div>
            <button type="submit" class="btn bg-black text-white w-full">Checkout</button>
          </form>
        </div>
      </div>
    </div>

    <div class="mt-8">
      <button onclick="location.href='index.php?modul=cust&fitur=shop'" class="btn btn-outline w-full">Back to Menu</button>
    </div>
  </div>
</body>
</html>
