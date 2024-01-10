<!DOCTYPE html>
<html>
<head>
    <title>Create Course - Step 2</title>
</head>
<body>

<form action="process_course1.php" method="post">
    <label for="category">Choose Category:</label>
    <select id="category" name="categoryId" required>

        <option value="1">Finance & Accounting</option>
        <option value="2">IT & Software</option>
        <option value="3">Office Productivity</option>
        <option value="4"> personal development</option>
        <option value="5">Design</option>
        <option value="6">Marketing</option>
        <option value="7">Life style</option>
        <option value="8">Photography & Video</option>
        <option value="9">Health & Fitness</option>
        <option value="10">Music</option>
        <option value="11">Teaching and Academics</option>
        <option value="12">I don't know yet</option>    
        
    </select>

    <button type="submit">Create Course</button>
</form>

</body>
</html>
