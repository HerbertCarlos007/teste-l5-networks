$(document).ready(function () {
  function fetchMovies(title = '') {
    $('#loading-spinner').show();
    let url = 'http://localhost/backend/index.php/movies';
    if (title) {
      url += `?title=${encodeURIComponent(title)}`;
    }

    $.ajax({
      url: url,
      method: 'GET',
      success: function (response) {
        try {
          let movies = response;
          if (typeof response === 'string') {
            movies = JSON.parse(response);
          }
          renderMovies(movies);

        } catch (error) {
          console.error('Erro ao processar os dados:', error);
        }
      },
      error: function (xhr, status, error) {
        console.error('Erro na requisição:', error);
      },
      complete: function () {
        $('#loading-spinner').hide();
      },
    });
  }

  function fetchFavoriteMovies() {
    $('#loading-spinner').show();

    $.ajax({
      url: 'http://localhost/backend/index.php/movies/favorites',
      method: 'GET',
      success: function (response) {
        try {
          let movies = response;
          if (typeof response === 'string') {
            movies = JSON.parse(response);
          }
          renderMovies(movies);

        } catch (error) {
          console.error('Erro ao processar os dados:', error);
        }
      },
      error: function (xhr, status, error) {
        console.error('Erro na requisição:', error);
      },
      complete: function () {
        $('#loading-spinner').hide();
      },
    });
  }

  function renderMovies(movies) {
    const catalog = $('#catalog');
    catalog.empty();

    movies.forEach((movie) => {
      const cardHtml = `
        <div class="col-12 col-md-6 col-lg-4 mb-4">
          <div 
            class="card shadow-sm rounded d-flex flex-column h-100 position-relative" 
            data-id="${movie.id}" 
            style="cursor: pointer"
          >
            <div 
              class="favorite-star" 
              data-id="${movie.id}" 
              data-favorite="${movie.is_favorite}" 
              style="position: absolute; top: 0px; left: -5px; z-index: 10;"
            >
              <i 
                class="${movie.is_favorite ? 'fa-solid fa-star text-warning' : 'fa-regular fa-star text-muted'}" 
                style="font-size: 24px; cursor: pointer;"
              ></i>
            </div>
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

    $('.favorite-star').on('click', function (event) {
      event.stopPropagation();
      const starContainer = $(this);
      const movieId = starContainer.data('id');
      const isFavorite = starContainer.data('favorite');
      const newFavoriteStatus = isFavorite ? 0 : 1;

      $.ajax({
        url: `http://localhost/backend/index.php/movies/${movieId}/favorite`,
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        data: JSON.stringify({ is_favorite: newFavoriteStatus }),
        success: function () {
          const starIcon = starContainer.find('i');
          starIcon
            .removeClass(isFavorite ? 'fa-solid fa-star text-warning' : 'fa-regular fa-star text-muted')
            .addClass(newFavoriteStatus ? 'fa-solid fa-star text-warning' : 'fa-regular fa-star text-muted');

          starContainer.data('favorite', newFavoriteStatus);
          fetchMovies();
        },
        error: function (xhr, status, error) {
          console.error('Erro ao alternar o favorito:', xhr.responseText || error);
        },
      });
    });
  }

  fetchMovies();

  $('#searchButton').on('click', function () {
    const title = $('#searchInput').val();
    fetchMovies(title);
  });

  $('#clearButton').on('click', function () {
    $('#searchInput').val('');
    fetchMovies();
  });

  $('#favoritesButton').on('click', function () {
    fetchFavoriteMovies();
  });
});
