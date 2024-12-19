const apiKey = "74595494";
const container = document.querySelector("#container");

function searchMovie() {
    const title = "Red One";
    const url = `http://www.omdbapi.com/?t="Red-One"&apikey=74595494`;

    fetch(url)
    .then(response => response.json())
    .then(data => {
        if (data.Response === "True") {
            let votes = data.imdbVotes;
            const numberedVotes = parseInt(votes.replace(/,/g, ""));
            console.log(numberedVotes);

            const text = `
            <section class="py-20 mx-auto w-4/6">
                <div class="flex justify-between">
                    <div>
                        <p id="title" class="text-5xl">${data.Title}</p>
                        <div class="flex gap-2">
                            <p>${data.Year}</p>
                            <p>${data.Rated}</p>
                            <p>${data.Runtime}</p>
                        </div>
                    </div>
                
                    <div class="flex flex-col font-bold text-gray-400">
                        <p class="tracking-wider">IMDb RATING</p>
                            <div class="flex items-start">
                                <svg width="40" height="40" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <path 
                                        d="M50 15 
                                        L61 38 
                                        Q63 43 68 43 
                                        L85 38 
                                        Q87 38 85 45 
                                        L67 55 
                                        Q65 57 66 63 
                                        L73 78 
                                        Q73 80 70 80 
                                        L50 65 
                                        Q48 64 46 65 
                                        L27 78 
                                        Q25 80 25 78 
                                        L33 55 
                                        Q33 53 31 51 
                                        L15 38 
                                        Q13 36 15 35 
                                        L39 38 
                                        Q41 38 45 38 
                                        Z" 
                                        fill="gold" 
                                        stroke="black" 
                                        stroke-width="2" />
                                </svg>
                                <div>
                                    <span class="font-bold text-xl text-white">${data.imdbRating}</span>/10
                                    <p class="text-xs">${numberedVotes >= 1000 ? `${votes.substr(0, 4)}k` : data.imdbVotes}</p>
                                </div>
                            </div>
                    </div>
                </div>
            
                <div class="flex items-center justify-between">
                    <div>
                        <div class="relative">
                            <img src="${data.Poster}" id="poster" class="rounded-xl rounded-tl-none w-56">
                            <button class="absolute bg-black text-white text-5xl top-0 opacity-50">+</button>
                        </div>
                        <div>
                            <p>${data.Genre}</p>
                        </div>  
                        <div>
                            <p class="font-bold">Director <span class="font-normal text-blue-400">${data.Director}</span></p>
                            <p class="font-bold">Writers <span class="font-normal text-blue-400">${data.Writer}</span></p>
                            <p class="font-bold">Stars <span class="font-normal text-blue-400">${data.Actors}</span></p>
                        </div>
                    </div>
                    <div>
                        <button>Add to Watchlist</button>
                        <p>${data.Metascore}</p>
                        <p>Metascore</p>
                    </div>
                </div>
            
            </section>
                <p class="">${data.Plot}</p>
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