<?php
include 'conn.php';

$searchTerm = '';
if (isset($_POST['search'])) { // Check if the search form has been submitted
    $searchTerm = $_POST['searchTerm']; // Set the $searchTerm variable to the submitted value
}

function searchOrders($conn, $tableFunction, $query) {
    if (isset($_POST['search'])) {
        $tableFunction($conn, $query);
    } else {
        $tableFunction($conn, "SELECT OrderTbl.*, AccountTbl.acc_name 
                                 FROM OrderTbl 
                                 JOIN AccountTbl 
                                 ON OrderTbl.acc_id = AccountTbl.acc_id");
    }
}

function getCustomerTable($conn, $tableFunction, $query) {
    if (isset($_POST['search'])) {
        $tableFunction($conn, $query);
    } else {
        $tableFunction($conn, "SELECT * FROM AccountTbl WHERE acc_role = 'customer'");
    }
}

function displayProducts($conn, $tableFunction, $firstquery, $query)
{
    if (isset($_POST['search'])) {
        $tableFunction($conn, $query);
    } else {
        $tableFunction($conn, $firstquery);
    }
}

function displayTable($conn, $tableFunction, $tableName, $query){
    if (isset($_POST['search'])) {
        $tableFunction($conn, $query);
    } else {
        $tableFunction($conn, "SELECT * FROM $tableName");
    }
}

function getOrderrrrrrTable($conn, $query) {
    $stmt = $conn->query($query);
    if ($stmt->rowCount() > 0) { ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Account Name</th>
                    <th>Order Status</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch()) : ?>
                    <tr>
                        <td><?php echo $row['ord_id']; ?></td>
                        <td><?php echo $row['acc_name']; ?></td>
                        <td><?php echo $row['ord_status']; ?></td>
                        <td><?php echo $row['ord_totalprice']; ?></td>
                        <td><?php echo $row['ord_dt']; ?></td>
                    </tr>
            <?php endwhile;
            } else {
                echo '<td> No results found.</td>';
            } ?>
            </tbody>
        </table>
    <?php
}