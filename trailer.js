const apiKey = "74595494";
const container = document.querySelector("#container")

function searchMovie() {
    const title = "Red One";
    const url = `http://www.omdbapi.com/?t="Red-One"&apikey=74595494`;
    console.log(url);

    fetch(url)
    .then(response => response.json())
    .then(data => {
        if (data.Response === "True") {
            const text = `
            <section class="bg-stone-900 flex flex-col text-white">
                <div class="flex items-center justify-around">
                    <div class="">
                        <p id="title" class="text-4xl">${data.Title}</p>
                        <div class="flex gap-3 text-zinc-400">
                            <p>${data.Year}</p>
                            <p>${data.Rated}</p>
                            <p>${data.Runtime}</p>
                        </div>
                    </div>
                    <div>
                        <p>IMDb RATING</p>
                        <p class="cursor-pointer text-gray-300 text-lg">
                            <span class="text-xl font-bold text-white">${data.imdbRating}</span>/10
                        </p>
                    </div>
                </div>
            
                <div class="flex justify-center">
                    <div class="relative">
                        <img src="${data.Poster}" id="poster" class="rounded-xl rounded-tl-none w-56">
                        <button class="absolute bg-black text-white text-5xl top-0 opacity-50">+</button>
                    </div>
                </div>
            </section>
            `

            container.innerHTML = text;
        } else {
            alert('Cannot load movie from api');
        }
    })
    .catch(error => {
        console.error("There was a problem with the fetch operation:", error);
    })
}

searchMovie();