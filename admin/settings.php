<?php
include '../database/config.php';
include '../links.php';
include '../essentials.php';
include 'essentials.php';
$sql = "Select * from hotel";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);
?>
<br><br><br>
<section class="main">
    <div class="container">
        <div class="hero">
            <h2>SETTINGS</h2>
        </div>
        <br>
        <div class="pro profile1">
            <h4>General Setting</h4>
            <form action="" method="post">
                <div class="data">
                    <div class="in">
                        <label for="">Site Logo </label><br>    
                        <div style="display:flex;justify-content:space-around">
                            <input type="file"accept="image/*" >
                            <img src="" alt="" width="50px" style="display:none"> 
                            <input id="link" name="logoid" style="display:none;border:none;padding:6px;" readonly>
                        </div>
                    </div>
                    <div class="in">
                        <label for="">Site Title </label><br>
                        <input type="text" placeholder="" name="Name" value="<?php echo $data[1]; ?>">
                    </div>
                    <div class="in">
                        <label for="">Hotel Email </label><br>
                        <input type="text" placeholder="" name="Email" value="<?php echo $data[13]; ?>">
                    </div>
                </div>
                <div class="data">
                    <div class="in">
                        <label for="">Hotel Phone </label><br>
                        <input type="text" placeholder="" name="Phone" value="<?php echo $data[2]; ?>">
                    </div>
                    <div class="in">
                        <label for="">Hotel Address </label><br>
                        <input type="text" placeholder="" name="Address" value="<?php echo $data[3]; ?>">
                    </div>
                </div>
                <button type="submit" name="update1" value="update1">Save Changes</button>
            </form>
            <?php
            if (isset($_POST['update1'])) {
                $Name = $_POST['Name'];
                $log = $_POST['logoid'];
                $Email = $_POST['Email'];
                $Address = $_POST['Address'];
                $Phone = $_POST['Phone'];
                $s1 = "UPDATE `hotel` SET `name`='$Name',Email='$Email',`phone` = '$Phone', `address` = '$Address',`logo` = '$log' WHERE `id` = '101' ";
                if ($conn->query($s1) == true) {
                   $msg = "Changes Saved in Database ";
                   alert($msg);
                   echo "<script>window.location.href='$currentURL';</script>";
                 } }
            ?>
        </div>
        <br>
        <div class="pro profile1">
            <h4>Home Section Details</h4>
            <form action="" method="post">
                <div class="data">
                    <div class="in">
                        <label for="">Hotel Tag Line</label><br>
                        <input type="text" placeholder="" name="tag_line" value="<?php echo $data[4]; ?>">
                    </div>
                    <div class="in">
                        <label for="">Site Sub Tag Line</label><br>
                        <input type="text" placeholder="" name="sub_tag_line" value="<?php echo $data[5]; ?>">
                    </div>
                </div>
                <button type="submit" name="update2" value="update2">Save Changes</button>
            </form>
            <?php
            if (isset($_POST['update2'])) {
                $tag_line = $_POST['tag_line'];
                $sub_tag_line = $_POST['sub_tag_line'];
                             $s2 = "UPDATE `hotel` SET `title` ='$tag_line', `sub_title` ='$sub_tag_line' WHERE `id` = '101' ";
                             if ($conn->query($s2) == true) {
                                $msg = "Changes Saved in Database ";
                                alert($msg);
                                echo "<script>window.location.href='$currentURL';</script>";
                            }
                        }
            ?>
        </div>
        <br>
        <div class="pro profile1">
            <h4>About Section Details</h4>
            <form action="" method="post">
                <div class="data">
                    <div class="in">
                        <label for="">Head Title</label><br>
                        <input type="text" placeholder="" name="head_title" value="<?php echo $data[6]; ?>">
                    </div>
                    <div class="in">
                        <label for="">Head Sub Title</label><br>
                        <input type="text" placeholder="" name="head_sub_title" value="<?php echo $data[7]; ?>">
                    </div>
                </div>
                <div class="data">
                    <div class="in">
                        <label for="">Head Sub Title </label><br>
                        <input type="text" placeholder="" name="head_sub_title2" value="<?php echo $data[8]; ?>">
                    </div>
                </div>
                <div class="data">
                    <div class="in">
                        <label for="">About Paragraph </label><br>
                        <textarea name="about_paragraph" id="" cols="30" rows="10"
                            value="<?php echo $data[9]; ?>"><?php echo $data[9]; ?></textarea>
                    </div>
                </div>
                <button type="submit" name="update3" value="update3">Save Changes</button>
            </form>
            <?php
            if (isset($_POST['update3'])) {
                $head_title = $_POST['head_title'];
                $head_sub_title = $_POST['head_sub_title'];
                $head_sub_title2 = $_POST['head_sub_title2'];
                $about_para = $_POST['about_paragraph'];
                $s3 = "UPDATE `hotel` SET `longpara1_head_title` ='$head_title', `longpara1_sub_title` ='$head_sub_title',`long_para1_subtitle`='$head_sub_title2', `long_para1` ='$about_para' WHERE `id` = '101' ";
                if ($conn->query($s3) == true) {
                    $msg = "Changes Saved in Database ";
                    alert($msg);
                    echo "<script>window.location.href='$currentURL';</script>";
                }
            }
            ?>
        </div>
        <div class="pro profile1">
            <h4>Second About Section Details</h4>
            <form action="" method="post">
                <div class="data">
                    <div class="in">
                        <label for="">Head Title</label><br>
                        <input type="text" placeholder="" name="head_title" value="<?php echo $data[10]; ?>">
                    </div>
                </div>
                <div class="data">
                    <div class="in">
                        <label for="">Head Sub Title </label><br>
                        <input type="text" placeholder="" name="head_sub_title" value="<?php echo $data[11]; ?>">
                    </div>
                </div>
                <div class="data">
                    <div class="in">
                        <label for="">About Paragraph </label><br>
                        <textarea name="about_paragraph" id="" cols="30" rows="10"
                            value="<?php echo $data[12]; ?>"><?php echo $data[12]; ?></textarea>
                    </div>
                </div>
                <button type="submit" name="update4" value="update4">Save Changes</button>
            </form>
            <?php
            if (isset($_POST['update4'])) {
                $head_title = $_POST['head_title'];
                $head_sub_title = $_POST['head_sub_title'];
                $about_para = $_POST['about_paragraph'];
                $s4 = "UPDATE `hotel` SET `long_para2_title` ='$head_title', `long_para2_sub_title` ='$head_sub_title', `long_para2` ='$about_para' WHERE `id` = '101' ";
                if ($conn->query($s4) == true) {
                    $msg = "Changes Saved in Database ";
                    alert($msg);
                    echo "<script>window.location.href='$currentURL';</script>";
                }
            }
            ?>
        </div>
    </div>
    <br>
    <script>
        let url = "https://script.google.com/macros/s/AKfycbyaUQQvkD6mkbP47ab-u1fvVGGezpkE3IuoR80M15xttk1xkK07DE0exW_Y95lbcUzZUw/exec";
let file = document.querySelector("input");
let img = document.querySelector("img");
file.addEventListener('change', () => {
    let fr = new FileReader();
    fr.addEventListener('loadend', () => {
        let res = fr.result;
        img.src = res;
        img.style.display="block";
        file.style.display="none";
        let spt = res.split("base64,")[1];
        let obj = {
            base64: spt,
            type: file.files[0].type,
            name: file.files[0].name
        }
        fetch(url, {
            method: "POST",
            body: JSON.stringify(obj)
        })
        .then(r => r.text())
        .then(data => {
            extract(data);
        });
    })
    fr.readAsDataURL(file.files[0])
});
function extract(link) {
    let linkinput = document.getElementById('link');
    const regex = /uc\?id=([a-zA-Z0-9_-]+)&export=download/;
    const match = link.match(regex);
    if (match && match.length > 1) {
        const fileId = match[1];
        console.log("Extracted File ID:", fileId);
        linkinput.style.display="block";
        document.getElementById("link").value = fileId;
    } else {
        console.error("Invalid Google Drive link");
    }
}
    </script>
</section>