const apiKey = "74595494";
const container = document.querySelector("#container")

function searchMovie() {
    const title = "Red One";
    const url = `http://www.omdbapi.com/?t=${title}&apikey=${apiKey}`;
    console.log(url);

    fetch(url)
    .then(response => response.json())
    .then(data => {
        if (data.Response === "True") {
            const text = `
                <section>
                <div>
                    <div>
                        <p id="title" class="text-4xl">${data.Title}</p>

                        <div class="flex gap-4">
                            <p id="type">${data.Type}</p>
                            <p id="year">${data.Year}</p>
                        </div>
                    </div>
                    
                </div>

                <div class="flex">
                    <div class="relative">
                        <img src="${data.Poster}" id="poster" class="rounded-xl rounded-tl-none h-auto w-52">
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
                    <p id="plot" class="w-5/6">${data.Plot}</p>
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