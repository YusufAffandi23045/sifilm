<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Film - {{ $movie->title }}</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
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

    /* Container */
    .container {
      width: 90%;
      margin: auto;
      padding: 30px 0;
    }
    
    .detail-container {
      display: flex;
      gap: 20px;
      align-items: flex-start;
    }

    .detail-image img {
      width: 400px;
      height: 600px;
      object-fit: cover;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .detail-text {
      flex: 1;
    }

    h2 {
      font-size: 28px;
      font-weight: bold;
    }
    
    .info {
      font-size: 18px;
      margin: 5px 0;
      padding-bottom: 8px; /* Jarak bawah sebelum garis */
      border-bottom: 1px solid #BDC3C7; /* Garis pembatas */
      width: 90%; /* Tidak mentok ke tepi */

    }

    .button-container {
      margin-top: 20px;
    }
    .button {
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      color: white;
      background-color: #2C3E50;
      font-size: 16px;
      display: inline-block;
      margin-bottom: 2px;
    }
    .button:hover {
      background-color: #1A252F;
    }

    @media (max-width: 768px) {
      .detail-container {
        flex-direction: column;
      }
      .detail-image img {
        width: 100%;
        max-width: 350px;
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
    <div class="button-container">
      <a href="{{ url('/') }}" class="button">🏠 Home</a>
    </div>
    
    <div class="detail-container">
      <div class="detail-image">
        @if($movie->image)
          <img src="{{ asset($movie->image) }}" alt="{{ $movie->title }}">
        @else
          <p><i>Gambar tidak tersedia</i></p>
        @endif
      </div>

      <div class="detail-text">
        <h2>{{ $movie->title }}</h2>
        <p class="info"><strong>Deskripsi:</strong> {{ $movie->description }}</p>
        <p class="info"><strong>Tahun Rilis:</strong> {{ $movie->release_year }}</p>
        <p class="info"><strong>Genre:</strong> 
          @foreach($movie->genres as $genre)
            {{ $genre->name }}{{ !$loop->last ? ', ' : '' }}
          @endforeach
        </p>
        <p class="info"><strong>Rating:</strong> ⭐ {{ $movie->rating }}</p>
        <p class="info"><strong>Durasi:</strong> ⏳ {{ $movie->durasi }} menit</p>
        <p class="info"><strong>Pemeran:</strong> {{ $movie->pemeran }}</p>
      </div>
    </div>
  </div>
  <script>
    // Toggle dropdown menu
    function toggleDropdown() {
      var dropdown = document.getElementById("dropdownContent");
      dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }
  </script>
</body>
</html>
