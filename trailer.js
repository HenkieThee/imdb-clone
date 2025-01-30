const omdbApiKey = "74595494";
const tmdbApiKey = "ad44c9ef1393dce98f4d2f0cfc319492";
const container = document.querySelector("#container");

function displayMovie(omdbData, trailer) {
        const votes = omdbData.imdbVotes;
        const numberedVotes = parseInt(votes.replace(/,/g, ""));

        const trailerEmbed = trailer
        ? `
            <iframe class="rounded-xl" width="760" height="386" src="https://www.youtube.com/embed/${trailer.key}" frameborder="0" allowfullscreen></iframe>
        `
        : `<p>No trailer available.</p>`

        const text = `
        <section class="mx-auto pb-10 pt-20 w-5/6">
            <div class="flex justify-between w-[90%]">
                <div>
                    <p id="title" class="text-5xl">${omdbData.Title}</p>
                    <div class="flex gap-2">
                        <p>${omdbData.Year}</p>
                        <p>${omdbData.Rated}</p>
                        <p>${omdbData.Runtime}</p>
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
                                <p>
                                    <span class="font-bold text-xl text-white">${omdbData.imdbRating}</span>/10
                                </p>
                                <p class="text-xs">${numberedVotes >= 1000 ? `${votes.substr(0, 3)}k` : omdbData.imdbVotes}</p>
                            </div>
                        </div>
                </div>
            </div>
        
            <div class="flex items-center">
                <div>
                    <div class="relative">
                        <img src="${omdbData.Poster}" id="poster" class="rounded-xl rounded-tl-none w-64">
                        <button class="absolute bg-black text-white text-5xl top-0 opacity-50">+</button>
                    </div>
                </div>

                <div class="px-4">
                    ${trailerEmbed}
                </div>

                <div class="flex flex-col gap-2">
                    <button class="bg-yellow-500 cursor-pointer flex flex-nowrap font-semibold rounded text-black text-sm p-1">Add to Watchlist</button>

                    <div>
                        <span class="flex gap-2">
                        Metascore:
                        <p class="${omdbData.Metascore <= 50 ? 'bg-red-400' : 'bg-green-400'} px-1 rounded">
                        ${omdbData.Metascore}
                        </p>
                        </span>
                    </div>

                    <div>
                        <span class="text-center">
                            <p>Box office:</p>
                            <p>${omdbData.BoxOffice}</p>
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <div class="flex flex-col gap-2 ml-32 pb-10 w-3/6">
            <div>
                <p>${omdbData.Genre}</p>
                <p>${omdbData.Plot}</p>
            </div>

            <div>
                <p class="font-bold">Director <span class="casting-info">${omdbData.Director}</span></p>
                <p class="font-bold">Writers <span class="casting-info">${omdbData.Writer}</span></p>
                <p class="font-bold">Stars <span class="casting-info">${omdbData.Actors}</span></p>
            </div>

            <p></p>
        </div>
        `

        container.innerHTML = text;
}

function fetchTrailerFromTMDB(imdbId, omdbData) {
    const tmdbSearchUrl = `https://api.themoviedb.org/3/find/${imdbId}?api_key=${tmdbApiKey}&external_source=imdb_id`;

    fetch(tmdbSearchUrl)
    .then(response => response.json())
    .then(data => {
        if (data.movie_results.length > 0) {
            const movieId = data.movie_results[0].id;
            fetchTrailerByMovieId(movieId, omdbData);
        } else {
            alert('Movie not found in TMDB');
        }
    })
    .catch(error => {
        console.error("There was a problem with the TMDB fetch operation:", error);
    });
}

function fetchTrailerByMovieId(movieId, omdbData) {
    const tmdbTrailerUrl = `https://api.themoviedb.org/3/movie/${movieId}/videos?api_key=${tmdbApiKey}`;

    fetch(tmdbTrailerUrl)
        .then(response => response.json())
        .then(data => {
            const trailers = data.results ? data.results.filter(video => video.type === "Trailer" && video.site === "YouTube") : [];
            const trailer = trailers.length > 0 ? trailers[0] : null;
            
            displayMovie(omdbData, trailer);
        })
        .catch(error => {
            console.error("There was a problem fetching the TMDB trailer:", error);
        });
}

function searchMovie() {
    const title = "The Matrix";
    const omdbUrl = `http://www.omdbapi.com/?t="${title}"&apikey=${omdbApiKey}`;

    fetch(omdbUrl)
    .then(response => response.json())
    .then(data => {
        if (data.Response === "True") {
            fetchTrailerFromTMDB(data.imdbID, data);
        } else {
            alert('Cannot load movie from OMDb api');
        }
    })
    .catch(error => {
        console.error("There was a problem with the OMDb fetch operation:", error);
    });
}

searchMovie();