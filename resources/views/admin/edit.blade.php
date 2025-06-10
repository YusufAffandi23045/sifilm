<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Film - {{ $movie->title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #ECF0F1;
            color: #2C3E50;
            margin: 0;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #2C3E50;
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar h2 {
            font-size: 22px;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background-color: #1A252F;
        }

        /* Main Content */
        .main {
            margin-left: 270px;
            width: calc(100% - 270px);
            padding: 20px;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #34495E;
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
        }

        .admin-header h1 {
            margin: 0;
        }

        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #BDC3C7;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            height: 100px;
        }

        .genre-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .genre-bubble {
            padding: 8px 12px;
            border-radius: 20px;
            border: 1px solid gray;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }

        .genre-bubble.selected {
            background-color: #007BFF;
            color: white;
        }

        .image-preview {
            margin-top: 15px;
            max-width: 150px;
            border-radius: 8px;
        }

        .button-container {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .button {
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .button.save {
            background-color: #27AE60;
        }

        .button.save:hover {
            background-color: #1D8348;
        }

        .button.cancel {
            background-color: #C0392B;
        }

        .button.cancel:hover {
            background-color: #A93226;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main {
                margin-left: 220px;
                width: calc(100% - 220px);
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="{{ url('/admin') }}">📂 Film</a>
        <a href="{{ url('/admin/genres') }}">🎭 Genre</a>
        <form action="{{ route('admin.logout') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <button type="submit" class="button" style="width: 100%; background-color: #C0392B;">
                Logout
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main">
        <div class="admin-header">
            <h1>Edit Film</h1>
        </div>

        <div class="form-container">
            @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/admin/' . $movie->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label>Judul:</label>
                <input type="text" name="title" value="{{ old('title', $movie->title) }}">

                <label>Deskripsi:</label>
                <textarea name="description">{{ old('description', $movie->description) }}</textarea>

                <label>Tahun Rilis:</label>
                <input type="number" name="release_year" value="{{ old('release_year', $movie->release_year) }}">

                <label>Gambar:</label>
                <input type="file" name="image" id="imageInput">
                @if($movie->image)
                    <img src="{{ asset($movie->image) }}" alt="Gambar Lama" class="image-preview" id="previewImage">
                @endif

                <label>Genre:</label>
                <div class="genre-container">
                    @foreach($genres as $genre)
                        <label class="genre-bubble {{ in_array($genre->id, $selectedGenres) ? 'selected' : '' }}">
                            {{ $genre->name }}
                            <input type="checkbox" name="genres[]" value="{{ $genre->id }}" {{ in_array($genre->id, $selectedGenres) ? 'checked' : '' }} style="display:none;">
                        </label>
                    @endforeach
                </div>

                <label>Rating:</label>
                <input type="number" step="0.1" name="rating" value="{{ old('rating', $movie->rating) }}">

                <label>Durasi (menit):</label>
                <input type="number" name="durasi" value="{{ old('durasi', $movie->durasi) }}">

                <label>Pemeran:</label>
                <textarea name="pemeran">{{ old('pemeran', $movie->pemeran) }}</textarea>

                <div class="button-container">
                    <button type="submit" class="button save">💾 Simpan</button>
                    <a href="{{ url('/admin') }}" class="button cancel">❌ Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("imageInput").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                document.getElementById("previewImage").src = URL.createObjectURL(file);
            }
        });

        document.querySelectorAll('.genre-bubble').forEach(label => {
            label.addEventListener('click', function () {
                const checkbox = this.querySelector('input[type="checkbox"]');
                checkbox.checked = !checkbox.checked;
                this.classList.toggle('selected');
            });
        });
    </script>
</body>
</html>