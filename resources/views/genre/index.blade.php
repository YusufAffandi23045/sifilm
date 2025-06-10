<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Genre</title>
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
            text-align: center;
        }

        h2 {
            font-size: 28px;
            font-weight: bold;
        }

        .genre-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .genre-card {
            background: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #2C3E50;
        }

        .genre-card:hover {
            background-color: #3498DB;
            color: white;
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .genre-list {
                flex-direction: column;
                align-items: center;
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
        <h2>Pilih Genre Film</h2>
        <div class="genre-list">
            @foreach($genres as $genre)
                <a href="{{ url('/genre/' . urlencode($genre->name)) }}" class="genre-card">
                    {{ $genre->name }}
                </a>
            @endforeach
        </div>
    </div>

    <script>
        function toggleDropdown() {
        var dropdown = document.getElementById("dropdownContent");
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }
    </script>

</body>
</html>