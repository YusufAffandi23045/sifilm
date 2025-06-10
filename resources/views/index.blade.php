<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Informasi Film</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Global Styles */
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #ECF0F1;
      color: #2C3E50;
      margin: 0;
      padding: 0;
    }
    
    /* Navbar start*/
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #2C3E50;
      color: white;
      padding: 15px 20px;
    }
    .navbar h1 {
      margin: 0;
      font-size: 24px;
      font-weight: bold;
      text-align: left;
    }
    .search-bar {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .search-form {
        position: relative;
        width: 60%;
        max-width: 400px;
    }

    .search-form input {
        width: 100%;
        padding: 10px 45px 10px 15px;
        border-radius: 25px;
        border: 2px solid #BDC3C7;
        outline: none;
        font-size: 16px;
        transition: 0.3s;
    }

    .search-form input:focus {
        border-color: #2C3E50;
    }

    .search-form button {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        color: #2C3E50;
        padding: 0;
    }

    .search-form button:hover {
        color: #f1c40f;
    }

    .home-icon a {
      font-size: 24px;
      text-decoration: none;
      color: white;
      margin-right: 15px;
    }
    .home-icon a:hover {
      color: #f1c40f;
    }
    
    /* Dropdown untuk icon garis tiga */
    .dropdown {
      position: relative;
      display: inline-block;
    }
    .menu-icon {
      cursor: pointer;
      font-size: 24px;
    }
    .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      background-color: white;
      min-width: 150px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      z-index: 1;
    }
    .dropdown-content a {
      color: #2C3E50;
      padding: 10px 15px;
      text-decoration: none;
      display: block;
    }
    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }
    /* Navbar finish */
    /* Container dan Carousel */
    .container {
      width: 90%;
      margin: auto;
      padding: 20px 0;
    }
    .carousel-container {
      width: 100%;
      overflow: hidden;
      margin-top: 20px;
    }
    .carousel {
      display: flex;
      transition: transform 1s ease-in-out;
    }
    .carousel-item {
      min-width: 100%;
    }
    .carousel-item img {
      width: 100%;
      height: 350px;
      object-fit: cover;
      border-radius: 10px;
    }
    
    /* Sections dan Movies */
    .section {
      margin-top: 30px;
      text-align: left;
    }
    .section h2 {
      font-size: 22px;
      font-weight: bold;
      margin-bottom: 15px;
    }
    .movies {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: flex-start;
    }
    .movie {
      width: 200px;
      background: white;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      padding: 10px;
      transition: transform 0.3s ease-in-out;
      text-align: left;
    }
    .movie:hover {
      transform: scale(1.05);
    }
    .movie img {
      width: 100%;    
      height: 300px;
      max-width: 200px;
      object-fit: cover;
      border-radius: 5px;
      display: block;
    }
    .movie-title {
      font-weight: bold;
      margin-top: 10px;
      text-align: left;
    }
    
    /* Responsif */
    @media (max-width: 768px) {
      .search-bar input {
        width: 80%;
      }
      .movie {
        width: 150px;
      }
      .carousel-item img {
        height: 210px;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <h1>Sistem Informasi Film</h1>
    <div class="search-bar">
      <form method="GET" action="{{ route('movies.search') }}" class="search-form">
        <input type="text" name="q" placeholder="Cari film..." required>
        <button type="submit">🔍</button>
      </form>
    </div>
    <div class="home-icon">
      <a href="{{ route('index') }}">🏠</a>
    </div>
    <div class="dropdown">
      <div class="menu-icon" onclick="toggleDropdown()">☰</div>
      <div class="dropdown-content" id="dropdownContent">
        <a href="{{ route('genre.index') }}">Genre</a>
        <a href="{{ route('year.index') }}">Rilis Tahun</a>
      </div>
    </div>
  </div>

  <div class="container">
    <!-- Carousel Film Acak -->
    <div class="carousel-container">
      <div class="carousel">
        @foreach($posterMovies as $poster)
          <div class="carousel-item">              
            <a href="{{ route('movies.show',['id' => $poster->id]) }}">
                <img src="{{ asset($poster->image) }}" alt="{{ $poster->title }}">
              </a>
          </div>
        @endforeach
      </div>
    </div>

    <div class="section">
      <h2>Daftar Film</h2>
      <div class="movies">
        @foreach($movies as $film)
          <div class="movie">
            <a href="{{ route('movies.show', ['id' => $film->id]) }}">
              <img src="{{ asset($film->image) }}" alt="{{ $film->title }}">
              <div class="movie-title">{{ $film->title }} ({{ $film->release_year }})</div>
            </a>
          </div>
        @endforeach
      </div>
      <div class="mt-6 flex justify-center">
          {{ $movies->links() }}
      </div>
    </div>
  </div>

  <script>
    // Toggle dropdown menu
    function toggleDropdown() {
      var dropdown = document.getElementById("dropdownContent");
      dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }
    
    // Carousel functionality
    let currentIndex = 0;
    const items = document.querySelectorAll('.carousel-item');
    const totalItems = items.length;

    function nextSlide() {
      currentIndex = (currentIndex + 1) % totalItems;
      updateCarousel();
    }
    function updateCarousel() {
      const offset = -currentIndex * 100;
      document.querySelector('.carousel').style.transform = `translateX(${offset}%)`;
    }
    
    setInterval(nextSlide, 4000);
    updateCarousel();
  </script>
</body>
</html>