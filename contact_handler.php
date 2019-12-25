<?php
    include "php/function/check_profile.php";
    include "php/function/run_query.php";
    
    
    if (session_status() == PHP_SESSION_NONE)
        session_start();

    check_profile();

    $profile = $_SESSION["profile"];

    
?>

<script>
    function change_sort() {
        var header = "";
        <?php 
            $sql = ["SELECT * FROM user ORDER BY id","SELECT * FROM user ORDER BY username","SELECT * FROM user ORDER BY fullName","SELECT * FROM user ORDER BY role"];
            if($profile["role"] != "staff"){
                $sql = ["SELECT * FROM user WHERE role = 'staff' ORDER BY id","SELECT * FROM user WHERE role = 'staff' ORDER BY username","SELECT * FROM user WHERE role = 'staff' ORDER BY fullName","SELECT * FROM user WHERE role = 'staff' ORDER BY role"];
            }
            function for_each($sql){
                $datas = get_assoc($sql);
                echo "<tr>
                <th>ID</th>
                <th>USERNAME</th>
                <th>FULL NAME</th>
                <th>ROLE</th>
                </tr>";
                foreach($datas as $data){
                    $data["role"][0] = "S";
                    echo "<tr>
                    <td>".$data["id"]."</td>
                    <td>".$data["username"]."</td>
                    <td>".$data["fullName"]."</td>
                    <td>".$data["role"]."</td>
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
    if($profile["role"] == "staff"){
        $datas = get_assoc("SELECT * FROM user ORDER BY id");
    }
    else{
        $datas = get_assoc("SELECT * FROM user WHERE role = 'staff' ORDER BY id ");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact</title>

    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/table.css">
</head>

<body>
    <?php include 'html/header.html' ?>
    <div>
        <form action="">
            <input type="text">
            <select name="" id="">
                <option value="">NAME</option>
                <option value="">USERNAME</option>
                <option value="">ANY</option>
            </select>
            <button>SEARCH</button>
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
            </tr>
            <?php
                foreach($datas as $data){
                    $data["role"][0] = "S";
                    echo "<tr>
                    <td>".$data["id"]."</td>
                    <td>".$data["username"]."</td>
                    <td>".$data["fullName"]."</td>
                    <td>".$data["role"]."</td>
                    </tr>";
                }
            ?>
        </table>
        <p id="blah"></p>
    </div>

    

    <?php include 'html/footer.html' ?>
</body>

</html>