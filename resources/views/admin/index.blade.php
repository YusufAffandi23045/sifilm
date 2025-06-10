<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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

        /* Table */
        table {
            width: 100%;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #BDC3C7;
        }

        th {
            background-color: #2C3E50;
            color: white;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .button {
            padding: 8px 12px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            font-size: 14px;
        }

        .button.add {
            background-color: #27AE60;
        }

        .button.edit {
            background-color: #F39C12;
        }

        .button.delete {
            background-color: #C0392B;
        }

        .button:hover {
            opacity: 0.8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            table {
                display: block;
                overflow-x: auto;
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
            <h1>Daftar Film</h1>
            <a href="{{ url('/admin/create') }}" class="button add">+ Tambah Film</a>
        </div>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tahun</th>
                    <th>Rating</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                <tr>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->release_year }}</td>
                    <td>⭐ {{ $movie->rating }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.show',['id' => $movie->id]) }}" class="button">👀 Lihat</a>
                        <a href="{{ url('/admin/' . $movie->id . '/edit') }}" class="button edit">✏️ Edit</a>
                        <form action="{{ url('/admin/' . $movie->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button delete" onclick="return confirm('Yakin ingin menghapus film ini?')">🗑 Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
