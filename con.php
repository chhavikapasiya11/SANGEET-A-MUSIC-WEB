<?php

header('Content-Type: application/json');
echo "Welcome to the stage where we are ready";

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musico";  

// Establish connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form data and sanitize
$id = $_POST['id'] ?? '';
$file_path = $_POST['file_path'] ?? '';
$title = $_POST['title'] ?? '';
$artist = $_POST['artist'] ?? '';

if ($id && $file_path && $title && $artist) {
    $stmt = $conn->prepare("INSERT INTO musictable (id, file_path, title, artist) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $id, $file_path, $title, $artist);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Retrieve songs for a specific playlist
$playlist = $_GET['playlist'] ?? '';
$songs = [];

if ($playlist) {
    $stmt = $conn->prepare("
        SELECT m.file_path, m.title, m.artist 
        FROM musictable m
        JOIN playlist_songs ps ON m.id = ps.song_id
        JOIN playlists p ON ps.playlist_id = p.playlist_id
        WHERE p.playlist_name = ?
    ");
    $stmt->bind_param("s", $playlist);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $songs = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "No songs available in this playlist.";
    }
    $stmt->close();
}

// Output songs as JSON
echo json_encode($songs);

// Close connection
$conn->close();

?>
