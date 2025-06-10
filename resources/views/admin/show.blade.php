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

        /* Navbar */
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
        .menu-icon {
            cursor: pointer;
            font-size: 24px;
        }

        /* Container */
        .container {
            width: 90%;
            margin: auto;
            padding: 30px 0;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .button {
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            background-color: #2C3E50;
            font-size: 16px;
        }
        .button:hover {
            background-color: #1A252F;
        }

        /* Detail Layout */
        .detail-container {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
            margin-bottom: 10px;
        }

        .info {
            font-size: 18px;
            margin: 5px 0;
            padding-bottom: 8px;
            border-bottom: 1px solid #BDC3C7;
            width: 90%;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .detail-container {
                flex-direction: column;
                text-align: center;
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
        <h1>Admin Panel</h1>
        <div class="menu-icon">☰</div>
    </div>

    <div class="container">
        <!-- Tombol Navigasi -->
        <div class="buttons">
            <a href="{{ url('/admin') }}" class="button">🏠 Home</a>
            <a href="{{ url('/admin/' . $movie->id . '/edit') }}" class="button">✏️ Edit</a>
        </div>

        <!-- Detail Film -->
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
                <p class="info"><strong>Kategori:</strong> {{ $movie->category ? $movie->category->name : 'Tidak tersedia' }}</p>
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

</body>
</html>