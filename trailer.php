<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trailer</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <main class="bg-white">
        <section class="flex items-center justify-between">
            <div>
                <p class="text-5xl">Bluey</p>

                <div class="flex gap-8 mb-4">
                    <p>TV series</p>
                    <p>2018</p>
                </div>
            
                <div class="ml-2 relative">
                    <img class="rounded rounded-tl-none" src="./images/poster.jpg" alt="">
                    <button class="absolute bg-black text-white text-xl top-0 p-2 opacity-50">+</button>
                </div>
            </div>

            <div class="box-office-container">
                <h2 class="font-bold text-3xl">Box office</h2>
                <div class="gap-4 grid grid-cols-2">
                    <h3 class="font-bold">Budget</h3>
                    <h3 class="font-bold">Gross US & Canada</h3>
                    <h3 class="font-bold">Opening weekend US & Canada</h3>
                    <h3 class="font-bold">Gross worldwide</h3>
                </div>
            </div>
        </section>

        <section class="story-container">
            <h3>Storyline</h3>
            <p>
                Bluey follows the adventures of a lovable and inexhaustible
                six-year-old Blue Heeler puppy who lives with her dad, mum and
                four-year-old little sister, Bingo. In every episode, Bluey
                uses her limitless Blue heeler energy to play elaborate games
                that unfold in unpredictable and hilarious ways.
            </p>
        </section>
    </main>
</body>
</html>