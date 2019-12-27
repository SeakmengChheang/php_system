<?php
    include "../../php/function/check_profile.php";
    include "../../php/function/run_query.php";
    include "../../php/function/message.php";
    include "FUNCTION/add_position.php";

    check_profile();

    if (session_status() == PHP_SESSION_NONE)
        session_start();

    $profile = $_SESSION["profile"];
    
    
?>

<script>

    function change_sort() {
        <?php 
            $sql = ["SELECT * FROM user ORDER BY id","SELECT * FROM user ORDER BY username","SELECT * FROM user ORDER BY fullName","SELECT * FROM user ORDER BY role"];
            if($profile["role"] != "staff"){
                $sql = ["SELECT * FROM user WHERE role = 'staff' ORDER BY id","SELECT * FROM user WHERE role = 'staff' ORDER BY username","SELECT * FROM user WHERE role = 'staff' ORDER BY fullName","SELECT * FROM user WHERE role = 'staff' ORDER BY role"];
            }
            function for_each($sql){
                $datas = get_assoc($sql);
                add_position($datas);
                echo "<tr>
                <th>ID</th>
                <th>USERNAME</th>
                <th>FULL NAME</th>
                <th>ROLE</th>
                <th>POSITION</th>
                </tr>";
                foreach($datas as $data){
                    $data["role"][0] = "S";
                    echo "<tr>
                    <td>".$data["id"]."</td>
                    <td>".$data["username"]."</td>
                    <td>".$data["fullName"]."</td>
                    <td>".$data["role"]."</td>
                    <td>".$data["position"]."</td>
                    </tr>";
                }
            }
        ?>
        if(document.getElementById("sortby").selectedIndex == "0"){
            document.getElementById("sortby-container").innerHTML =  `<?php for_each($sql[0]) ?>`;
        }
        else if(document.getElementById("sortby").selectedIndex == "1"){
            document.getElementById("sortby-container").innerHTML =  `<?php for_each($sql[1]) ?>`;
        }
        else if(document.getElementById("sortby").selectedIndex == "2"){
            document.getElementById("sortby-container").innerHTML = `<?php for_each($sql[2]) ?>`;
        }
        else if(document.getElementById("sortby").selectedIndex == "3"){
            document.getElementById("sortby-container").innerHTML = `<?php for_each($sql[3]) ?>`;
        }
    }
</script>

<?php
    $searchdatas = $_SESSION["search"] ?? "";
    if($searchdatas == ""){
        if($profile["role"] == "staff"){
            $datas = get_assoc("SELECT * FROM user ORDER BY id");
        }
        else{
            $datas = get_assoc("SELECT * FROM user WHERE role = 'staff' ORDER BY id ");
        }
    }
    else{
        $datas = $searchdatas;
        $_SESSION["search"] = "";
    }
    add_position($datas);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact</title>

    <link rel="stylesheet" href="../../css/template.css">
    <link rel="stylesheet" href="../../css/table.css">
</head>

<body>
    <?php include '../../html/header.html' ?>
    <div>
        <form action="search.php" method = "POST">
            <input type="text" name = "input_search">
            <select name="option" >
                <option value = "0">-none-</option>
                <option value = "1">NAME</option>
                <option value = "2">USERNAME</option>
                <option value = "3">ANY</option>
            </select>
            <button type = "submit">SEARCH</button>
        </form>
        sortby:
        <form onchange="change_sort()" action="">
            <select name="" id="sortby">
                <option>ID</option>
                <option>USERNAME</option>
                <option>NAME</option>
                <?php if($profile["role"] == "staff") echo "<option>ROLE</option>"; ?>
            </select>
        </form>
        <!-- <button>SORT</button> -->
    </div>
    <div>
        <table id = "sortby-container">
            <tr>
                <th>ID</th>
                <th>USERNAME</th>
                <th>FULL NAME</th>
                <th>ROLE</th>
                <th>POSITION</th>
            </tr>
            <?php
                foreach($datas as $data){
                    $data["role"][0] = "S";
                    echo "<tr>
                    <td>".$data["id"]."</td>
                    <td>".$data["username"]."</td>
                    <td>".$data["fullName"]."</td>
                    <td>".$data["role"]."</td>
                    <td>".$data["position"]."</td>
                    </tr>";
                }
            ?>
        </table>
        <p id="blah"></p>
    </div>

    

    <?php include '../../html/footer.html' ?>
</body>

</html>