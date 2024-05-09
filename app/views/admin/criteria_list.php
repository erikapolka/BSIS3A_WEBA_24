<?php include 'partials/adminpage_header.php'; ?>

<form method="post" action="update_order.php">
    <ul>
        
            <li>
                Order: 
                <input type="number" name="order" value="1">
            </li>
        
    </ul>
    <button type="submit">Save Order</button>
</form>

<?php include 'partials/adminpage_footer.php'; ?>