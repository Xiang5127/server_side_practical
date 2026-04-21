<?php
$con = mysqli_connect("localhost", "root", "", "ajax_demo");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $action = $_GET['action'] ?? '';

    if ($action === 'display') {
        $recordsPerPage = isset($_GET['recordsPerPage']) ? (int)$_GET['recordsPerPage'] : 3;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $recordsPerPage;

        $sql = "SELECT * FROM users LIMIT $offset, $recordsPerPage";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <button onclick='editUser({$row['id']})'>Edit</button>
                        <button onclick='deleteUser({$row['id']})'>Delete</button>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No users found</td></tr>";
        }
    }

    elseif ($action === 'search') {
        $search = $_GET['search'] ?? '';
        $sql = "SELECT * FROM users WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div>{$row['name']} - {$row['email']}</div>";
        }
    }

    elseif ($action === 'getSingleUser') {
        $id = (int)($_GET['id'] ?? 0);
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = mysqli_query($con, $sql);
        echo json_encode(mysqli_fetch_assoc($result));
    }

    elseif ($action === 'countRecords') {
        $result = mysqli_query($con, "SELECT COUNT(*) AS total FROM users");
        $row = mysqli_fetch_assoc($result);
        echo $row['total'];
    }
}

elseif ($method === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        mysqli_query($con, "INSERT INTO users (name, email) VALUES ('$name', '$email')");
    }

    elseif ($action === 'edit') {
        $id = (int)($_POST['id'] ?? 0);
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        mysqli_query($con, "UPDATE users SET name='$name', email='$email' WHERE id=$id");
    }

    elseif ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        mysqli_query($con, "DELETE FROM users WHERE id=$id");
    }
}
?>