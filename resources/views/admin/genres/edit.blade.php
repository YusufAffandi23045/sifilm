<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Genre</title>
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

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #BDC3C7;
            border-radius: 5px;
            font-size: 16px;
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
            <h1>Edit Genre</h1>
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

            <form action="{{ url('/admin/genres/' . $genre->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label>Nama Genre:</label>
                <input type="text" name="name" value="{{ old('name', $genre->name) }}">

                <div class="button-container">
                    <button type="submit" class="button save">💾 Simpan</button>
                    <a href="{{ url('/admin/genres') }}" class="button cancel">❌ Batal</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>