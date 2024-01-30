<select name="barangay" id="barangay">
    <option>- Select Your Barangay -</option>
    <?php 
        include("utilities/information/barangay_info.php");
        foreach($barangay as $value) {
            echo '<option>'.trim($value).'</option>';
        }
    ?>
</select>


