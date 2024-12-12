<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trailer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main class="bg-white">
        <div class="flex flex-col items-center justify-center">
        <section class="">
            <div>
                <p id="title" class="text-4xl"></p>

                <div class="flex gap-4">
                    <p id="type"></p>
                    <p id="year"></p>
                </div>
            </div>

            <div class="flex">
                <div class="relative">
                    <img id="poster" class="rounded-xl rounded-tl-none h-auto w-52">
                    <button class="absolute bg-black text-white text-xl top-0 p-2 opacity-50">+</button>
                </div>
                <div class="flex items-center">
                    <iframe class="max-w-full" width="600" height="280" src="https://www.youtube.com/embed/ZrR9ML0sxEE" title="" frameBorder="0"   allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"  allowFullScreen></iframe>
                </div>

                <div>
                <h2 class="font-bold text-3xl">Box office</h2>
                <div class="gap-4 grid grid-cols-2">
                    <div>
                        <h3 class="font-bold">Budget</h3>
                        <p>$50-65 million</p>
                    </div>
                    <div>
                        <h3 class="font-bold">Gross US & Canada</h3>
                        <p>$105.2 million</p>
                    </div>
                    <div>
                        <h3 class="font-bold">Opening weekend US & Canada</h3>
                        <p>$22.1 million</p>
                    </div>
                    <div>
                        <h3 class="font-bold">Gross worldwide</h3>
                        <p>$296.1 million</p>
                    </div>
                </div>
            </div>
            </div>
        </section>
        
        <section>
            <div>
                <p id="plot" class="w-5/6"></p>
            </div>
        </section>
        </div>
    </main>
    <script src="trailer.js"></script>
</body>
</html>