<?php
?>

<h1>Create an account</h1>

<form action="" method="post">
    <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" name="firstName" class="form-control" id=first-name>
    </div>
    <div class="form-group">
        <label for="lastName">Last Name</label>
        <input type="text" name="lastName" class="form-control" id="last-name">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" id="email">
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" class="form-control" id="password">
    </div>
    <div class="form-group">
        <label for="confirmPassword">Confirm password</label>
        <input type="password" name="confirmPassword" class="form-control" id="confirmPassword">
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
</form>
