$(document).ready(function () {
    // Função para buscar filmes
    function fetchMovies() {
      $.ajax({
        url: 'http://localhost/backend/index.php/movies',
        method: 'GET',
        success: function (response) {
          try {
            renderMovies(response);
          } catch (error) {
            console.error('Erro ao processar os dados:', error);
          }
        },
        error: function (xhr, status, error) {
          console.error('Erro na requisição:', error);
        },
      });
    }

    function renderMovies(movies) {
      const catalog = $('#catalog');
      catalog.empty();
  
      movies.forEach((movie) => {
        const cardHtml = `
          <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm rounded d-flex flex-column h-100" data-id="${movie.id}" style="cursor: pointer">
              <div class="card-body d-flex flex-column">
                <img 
                  src="/src/assets/img/image.png" 
                  alt="Star Wars" 
                  class="img-fluid rounded mb-3"
                />
                <h5 class="card-title text-primary fw-bold">${movie.title}</h5>
                <p class="card-text text-muted">
                  <strong>Data de Lançamento:</strong> ${movie.release_date}
                </p>
              </div>
            </div>
          </div>
        `;
        catalog.append(cardHtml);
      });
  
      $('.card').on('click', function () {
        const movieId = $(this).data('id');

        window.location.href = `/src/assets/views/movie-details.html?id=${movieId}`;
      });
    }
  
    fetchMovies();
});
