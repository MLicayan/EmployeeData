<?php
$conn = mysqli_connect("localhost", "root", "", "xml_activity");

$affectedRow = 0;

$xml = simplexml_load_file("employee.xml") or die ("Error: Cannot create object");
echo "<table>";
foreach ($xml->children() as $row){
    echo "<tr>";
    echo "<td>" . $row->employee_id . "</td>";
    echo "<td>" . $row->first_name . "</td>";
    echo "<td>" . $row->last_name . "</td>";
    echo "<td>" . $row->email . "</td>";
    echo "<td>" . $row->phone_number . "</td>";
    echo "<td>" . $row->hire_date . "</td>";
    echo "<td>" . $row->job_id . "</td>";
    echo "<td>" . $row->salary . "</td>";
    echo "/<tr>";
}
echo "</table>";

foreach ($xml->children() as $row){
    $employee_id = $row-> employee_id;
    $first_name = $row-> first_name;
    $last_name = $row-> last_name;
    $email = $row-> email;
    $phone_number = $row-> phone_number;
    $hire_date = $row-> hire_date;
    $job_id = $row-> job_id;
    $salary = $row-> salary;

    $sql = "INSERT INTO employees(
        employee_id,
        first_name,
        last_name,
        email,
        phone_number,
        hire_date,
        job_id,
        salary
    ) VALUES (
        '" . $employee_id . "',
        '" . $first_name . "',
        '" . $last_name . "',
        '" . $email . "',
        '" . $phone_number . "',
        '" . $hire_date . "',
        '" . $job_id . "',
        '" . $salary . "'
    )";

    $result = mysqli_query($conn, $sql);

    if(!empty($result)){
        $affectedRow ++;
    }else{
        $error_message = mysqli_error($con) . "\n";
    }
}
?>

<h2>Insert XML Data to MySql Table Output</h2>
<?php
if ($affectedRow > 0){
    $message = $affectedRow . " records inserted";
}else{
    $message = "No records inserted";
}
?>

<style>
body {  
    max-width:550px;
    font-family: Arial;
}
.affected-row {
	background: #cae4ca;
	padding: 10px;
	margin-bottom: 20px;
	border: #bdd6bd 1px solid;
	border-radius: 2px;
    color: #6e716e;
}
.error-message {
    background: #eac0c0;
    padding: 10px;
    margin-bottom: 20px;
    border: #dab2b2 1px solid;
    border-radius: 2px;
    color: #5d5b5b;
}
</style>

<div class="affected-row"><?php  echo $message; ?></div>
<?php if (! empty($error_message)) { ?>
<div class="error-message"><?php echo nl2br($error_message); ?></div>
<?php } ?>