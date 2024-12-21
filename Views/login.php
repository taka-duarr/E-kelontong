<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
        crossorigin="anonymous"
    />
</head>
<body class="bg-white text-black">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="flex flex-col bg-black shadow-md px-6 py-8 rounded-3xl w-80 max-w-md">
            <div class="font-medium self-center text-xl sm:text-3xl text-white">
                E-kelontong
            </div>
            <div class="mt-4 self-center text-sm sm:text-base text-gray-300">
                Silahkan login untuk melanjutkan
            </div>
            <div class="mt-10">
                <?php if (isset($error)) { ?>
                    <div class="p-4 mb-4 text-sm text-red-600 bg-red-100 rounded">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php } ?>
                <form method="POST">
                    <div class="flex flex-col mb-5">
                        <label for="nama_user" class="mb-1 text-xs tracking-wide text-gray-300">Username:</label>
                        <div class="relative">
                            <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <input
                                type="text"
                                name="nama_user"
                                id="nama_user"
                                placeholder="Enter your username"
                                required
                                class="text-sm placeholder-gray-400 bg-gray-700 text-white pl-10 pr-4 rounded-2xl border border-gray-600 w-full py-2 focus:outline-none focus:border-blue-400"
                            />
                        </div>
                    </div>
                    <div class="flex flex-col mb-6">
                        <label for="password_user" class="mb-1 text-xs tracking-wide text-gray-300">Password:</label>
                        <div class="relative">
                            <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                                <i class="fas fa-lock text-white"></i>
                            </div>
                            <input
                                type="password"
                                name="password_user"
                                id="password_user"
                                placeholder="Enter your password"
                                required
                                class="text-sm placeholder-gray-400 bg-gray-700 text-white pl-10 pr-4 rounded-2xl border border-gray-600 w-full py-2 focus:outline-none focus:border-blue-400"
                            />
                        </div>
                    </div>
                    <div class="flex w-full">
                        <button
                            type="submit"
                            class="flex items-center justify-center w-full py-2 text-sm text-black bg-white hover:bg-blue-600 rounded-2xl transition duration-150 ease-in"
                        >
                            <span class="mr-2 uppercase">Login</span>
                            <span>
                                <i class="fas fa-sign-in-alt"></i>
                            </span>
                        </button>
                    </div>
                    <div class="flex justify-center items-center mt-6">
                        <a
                            href="register.php"
                            class="inline-flex items-center text-white text-xs font-medium"
                        >
                            <span>Belum punya akun? <span class="text-blue-500 font-semibold">Daftar disini</span></span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>
