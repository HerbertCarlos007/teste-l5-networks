$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const movieId = urlParams.get('id');

    if (movieId) {
        fetchMovieDetails(movieId);
    } else {
        console.error('ID do filme não encontrado na URL');
    }

    function fetchMovieDetails(id) {
        $.ajax({
            url: `http://localhost/backend/index.php/movies/${id}`,
            method: 'GET',
            success: function (response) {
                try {
                    renderMovieDetails(response);
                } catch (error) {
                    console.error('Erro ao processar os dados do filme:', error);
                }
            },
            error: function (xhr, status, error) {
                console.error('Erro na requisição dos detalhes:', error);
            },
        });
    }

    function renderMovieDetails(movie) {
        const movieDetailsContainer = $('#movie-details-container');
        movieDetailsContainer.empty();


        const movieDetails = `
        <div class="card shadow-lg rounded-3 mb-4" style="max-width: 600px; margin: auto;">
            <div class="card-body">
                <h5 class="card-title text-center text-primary fs-3 fw-bold">${movie.title}</h5>
                <p class="fs-5"><strong>Sinopse:</strong> ${movie.opening_crawl}</p>
                <p class="fs-5"><strong>Data de Lançamento:</strong> ${movie.release_date}</p>
                <p class="fs-5"><strong>Diretor(a):</strong> ${movie.director}</p>
                <p class="fs-5"><strong>Produtores:</strong> ${movie.producer}</p>
                <p class="fs-5"><strong>Personagens:</strong> ${movie.characters}</p>
                <p class="fs-5"><strong>Idade do Filme:</strong> ${movie.age}</p>
                </div>
        </div>
      `;
        movieDetailsContainer.html(movieDetails);
    }
});
