<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class("bg-[#ebddc9]"); ?>>


    <!-- پیام خوشامدگویی -->
    <div id="welcomeMessage" class="fixed inset-0 flex items-center justify-center hidden z-50">

        <div class="absolute inset-0 backdrop-blur-md bg-black/40"></div>

        <!-- جعبه پیام -->
        <div class="relative bg-gradient-to-br from-[#fffaf5] to-[#f4e4d7] border border-gray-300 rounded-3xl shadow-2xl p-8 sm:p-12 text-center max-w-lg w-11/12 animate-fadeSlide z-50">

            <!-- متن خوشامد -->
            <p id="welcomeText" class="text-2xl sm:text-3xl font-extrabold text-[#1c2a3a] mb-4"></p>

            <!-- شعر -->
            <p id="poemText" class="text-base sm:text-lg text-gray-700 italic leading-relaxed mb-2"></p>
            <p id="poetText" class="text-sm text-gray-500 mb-6"></p>

            <!-- دکمه بستن -->
            <button id="closeWelcome" class="px-8 py-3 bg-[#940303] text-white rounded-xl font-semibold hover:bg-red-700 hover:scale-105 transform transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-red-400 focus:ring-offset-2">
                بستن
            </button>
        </div>
    </div>

    <style>
        @keyframes fadeSlide {
            from {
                transform: translateY(-40px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-fadeSlide {
            animation: fadeSlide 0.7s ease-out;
        }
    </style>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (!sessionStorage.getItem("welcomeShown")) {

                const poems = [{
                        text: "زندگی زیباست هر چند کوتاه است",
                        poet: "سهراب سپهری"
                    },
                    {
                        text: "دوست داشتن تو مرا کامل می‌کند",
                        poet: "فروغ فرخزاد"
                    },
                    {
                        text: "هر روزت پر از شادی و آرامش باد",
                        poet: "مولانا"
                    },
                    {
                        text: "عشق همچون نور در دل می‌تابد",
                        poet: "حافظ"
                    },
                    {
                        text: "از هر شکستی، پیروزی تازه می‌آید",
                        poet: "نیما یوشیج"
                    },
                    {
                        text: "خودت باش و از زندگی لذت ببر",
                        poet: "سهراب سپهری"
                    },
                    {
                        text: "دوستی، گوهری است گران‌بها",
                        poet: "فروغ فرخزاد"
                    },
                    {
                        text: "هر صبح، فرصت تازه‌ای است",
                        poet: "مولانا"
                    },
                    {
                        text: "دل آرام، زندگی آرام می‌آورد",
                        poet: "حافظ"
                    },
                    {
                        text: "به خودت ایمان داشته باش",
                        poet: "نیما یوشیج"
                    }
                ];

                const randomPoem = poems[Math.floor(Math.random() * poems.length)];

                // اسم کاربر (از وردپرس)
                const userName = "<?php echo is_user_logged_in() ? esc_js(wp_get_current_user()->display_name) : ''; ?>";
                const welcomeText = userName ? `${userName} عزیز، خوش آمدید! 🌸` : "خوش آمدید! 🌸";

                document.getElementById("welcomeText").textContent = welcomeText;
                document.getElementById("poemText").textContent = randomPoem.text;
                document.getElementById("poetText").textContent = `— ${randomPoem.poet}`;

                setTimeout(function() {
                    document.getElementById("welcomeMessage").classList.remove("hidden");
                    document.getElementById("welcomeMessage").classList.add("flex");
                }, 1000);

                sessionStorage.setItem("welcomeShown", "true");
            }

            document.getElementById("closeWelcome").addEventListener("click", function() {
                document.getElementById("welcomeMessage").classList.add("hidden");
                document.getElementById("welcomeMessage").classList.remove("flex");
            });
        });
    </script>




    <header class="bg-[#fff6eb] w-full h-22 flex items-center justify-between px-6 md:px-20">
        <!-- Left Section: Logo + Menu Button -->
        <div class="flex items-center gap-6">
            <?php if (function_exists("the_custom_logo")) {
                the_custom_logo();
            } ?>

            <!-- دکمه منوی موبایل (فقط توی موبایل دیده میشه) -->
            <button id="menu-toggle" class="md:hidden inline-flex items-center p-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#1c2a3a" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1zm0-4a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1zm0-4a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1z" />
                </svg>
            </button>

            <!-- منوی دسکتاپ -->
            <nav class="hidden md:flex ml-10">
                <?php
                wp_nav_menu([
                    'theme_location' => 'Header',
                    'menu_class' => 'flex gap-6 text-[#1c2a3a] font-semibold',
                    'container' => false,
                ]);
                ?>
            </nav>
        </div>

        <!-- Right Section: Icons -->
        <div class="flex items-center gap-5">
            <?php
            $count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
            ?>

            <a href="<?php echo wc_get_cart_url(); ?>" class="relative inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                </svg>
                <?php if ($count > 0): ?>
                    <span class="absolute -top-2 -right-2 inline-flex items-center justify-center 
                    px-[6px] text-xs font-bold text-white 
                    bg-red-600 rounded-full">
                        <?php echo esc_html($count); ?>
                    </span>
                <?php endif; ?>
            </a>


            <!-- Login -->
            <?php
            $login_page = get_page_by_path('login'); // 'login' را با اسلاگ صفحهٔ خودت عوض کن
            if ($login_page) {
                $login_url = get_permalink($login_page->ID);
            } else {
                // اگر صفحه پیدا نشد، یک fallback به لاگین وردپرس بده
                $login_url = wp_login_url();
            }
            ?>
            <a href="<?php echo esc_url($login_url); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                </svg>
            </a>

        </div>
    </header>

    <!-- منوی موبایل -->
    <nav id="mobile-menu" class="hidden md:hidden bg-[#fff6eb] w-full px-6 py-4">
        <?php
        wp_nav_menu([
            'theme_location' => 'Header',
            'menu_class' => 'flex flex-col gap-4 text-[#1c2a3a] font-semibold',
            'container' => false,
        ]);
        ?>
    </nav>

    <!-- Script -->
    <script>
        const toggleBtn = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        toggleBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>