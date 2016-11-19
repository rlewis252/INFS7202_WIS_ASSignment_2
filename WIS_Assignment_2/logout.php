<?php
// Inialize session
session_start();

// Delete all session variables
session_destroy();

// Direct to login page
header('Location: index.php');