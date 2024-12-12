const apiKey = "74595494";

function searchMovie() {
    const title = "Bluey";
    const url = `http://www.omdbapi.com/?t=${title}&apikey=${apiKey}`;
    console.log(url);

    fetch(url)
    .then(response => response.json())
    .then(data => {
        if (data.Response === "True") {
            document.querySelector("#title").innerText = `${data.Title}`;
            document.querySelector("#type").innerText = 'TV ' + `${data.Type}`
            document.querySelector("#year").innerText = `${data.Year}`;
            document.querySelector("#plot").innerText = `${data.Plot}`;
            document.querySelector("#poster").src = data.Poster;
        } else {
            alert('Cannot load movie from api');
        }
    })
    .catch(error => {
        console.error("There was a problem with the fetch operation:", error);
    })
}

searchMovie();