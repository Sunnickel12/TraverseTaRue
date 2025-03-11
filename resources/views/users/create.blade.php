<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create User</title>
</head>
<body>
    <h1>Create User</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <label>Name: <input type="text" name="name" required></label><br>
        <label>First Name: <input type="text" name="first_name" required></label><br>
        <label>Birthdate: <input type="date" name="birthdate" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <label>Profile Picture (URL): <input type="text" name="pp" required></label><br>
        <label>Class ID: <input type="number" name="id_classes" required></label><br>
        <label>Role ID: <input type="number" name="id_role" required></label><br>

        <button type="submit">Create</button>
    </form>
</body>
</html>
