<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
        crossorigin="anonymous"
    />
    <title>Join Us</title>
</head>
<body class="bg-white text-black">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="flex flex-col bg-black shadow-md px-6 py-8 rounded-3xl w-80 max-w-md">
            <div class="font-medium self-center text-xl sm:text-3xl text-white">
                E-Kelontong
            </div>
            <div class="mt-4 self-center text-sm sm:text-base text-gray-300">
                Silahkan isi data untuk bergabung
            </div>

            <div class="mt-10">
                <form action="#">
                    <div class="flex flex-col mb-5">
                        <label
                            for="email"
                            class="mb-1 text-xs tracking-wide text-gray-300"
                        >E-Mail Address:</label>
                        <div class="relative">
                            <div
                                class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400"
                            >
                                <i class="fas fa-at text-white"></i>
                            </div>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                class="
                                    text-sm
                                    placeholder-gray-400
                                    bg-gray-700
                                    text-white
                                    pl-10
                                    pr-4
                                    rounded-2xl
                                    border border-gray-600
                                    w-full
                                    py-2
                                    focus:outline-none focus:border-blue-400
                                "
                                placeholder="Enter your email"
                            />
                        </div>
                    </div>
                    <div class="flex flex-col mb-6">
                        <label
                            for="password"
                            class="mb-1 text-xs sm:text-sm tracking-wide text-gray-300"
                        >Password:</label>
                        <div class="relative">
                            <div
                                class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400"
                            >
                                <i class="fas fa-lock text-white"></i>
                            </div>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="
                                    text-sm
                                    placeholder-gray-400
                                    bg-gray-700
                                    text-white
                                    pl-10
                                    pr-4
                                    rounded-2xl
                                    border border-gray-600
                                    w-full
                                    py-2
                                    focus:outline-none focus:border-blue-400
                                "
                                placeholder="Enter your password"
                            />
                        </div>
                    </div>

                    <div class="flex w-full">
                        <button
                            type="submit"
                            class="
                                flex
                                items-center
                                justify-center
                                w-full
                                py-2
                                text-sm
                                text-black
                                bg-white
                                hover:bg-blue-600
                                rounded-2xl
                                transition
                                duration-150
                                ease-in
                            "
                        >
                            <span class="mr-2 uppercase">Sign Up</span>
                            <span>
                                <i class="fas fa-user-plus"></i>
                            </span>
                        </button>
                    </div>
                    <div class="flex justify-center items-center mt-6">
                        <a
                            href="login.php"
                            class="inline-flex items-center text-white text-xs font-medium"
                        >
                            <span>Sudah punya akun? <span class="text-blue-500 font-semibold">Login disini</span></span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

       
    </div>
</body>
</html>
