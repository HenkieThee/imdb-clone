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
            <section class="flex flex-col items-center mx-40">
                <div class="flex items-center">
                    <div>
                        <p id="title" class="text-4xl">${data.Title}</p>
                        <div class="flex">
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
            
                <div class="">
                    <div class="relative">
                        <img src="${data.Poster}" id="poster" class="rounded-xl rounded-tl-none w-56">
                        <button class="absolute bg-black text-white text-5xl top-0 opacity-50">+</button>
                    </div>
                </div>
                
                <div class="flex gap-4 items-center">
                    <div>
                    <p class="p-4 w-4/6">${data.Plot}</p>
                    <hr class="text-gray-300 w-max">
                    <p class="font-bold p-4">Director <span class="font-normal text-blue-400">${data.Director}</span></p>
                    <hr class="text-gray-300">
                    <p class="font-bold p-4">Writers <span class="font-normal text-blue-400">${data.Writer}</span></p>
                    <hr class="text-gray-300">
                    <p class="font-bold p-4">Stars <span class="font-normal text-blue-400">${data.Actors}</span></p>
                    </div>

                    <div>
                        <button>Add to Watchlist</button>
                        <div>
                            <p>${data.Metascore}</p>
                            <p>Metascore</p>
                        </div>
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