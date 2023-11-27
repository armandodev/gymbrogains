<?php
require_once "./../includes/session.php";

function getUsers($page, $usersPerPage)
{
  $offset = ($page - 1) * $usersPerPage;
  $sql = "SELECT * FROM users LIMIT $usersPerPage OFFSET $offset";

  $conn = $db->connect();
  $result = $conn->query($sql);
  $users = $result->fetch_all(MYSQLI_ASSOC);

  return $users;
}
