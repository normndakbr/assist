<div class="col-xl-12 col-lg-12 text-center">
    <h1><b>Administration Integrated System</b></h1>
    <h3>We are the best team of mining | Utamakan keselamatan kerja</h3>
</div>

<div class="col-xl-12 col-lg-12" style="margin-top:-50px;">
    <div class="row icon-boxes">
        <?php
        session_start();
        include "dbconn.php";
        $iduser =   $_SESSION['idusermsys'];

        if ($iduser == "") {
            header("Location: login.php");
        } else {
            $sqlmenu = mysqli_query($conn, "SELECT * FROM vwappuser WHERE idUser=" . $iduser);
            if ($sqlmenu->num_rows > 0) {
                while ($rwmenu = mysqli_fetch_assoc($sqlmenu)) {
                    $jmlapp = $sqlmenu->num_rows;
                    if ($jmlapp == 1) {
                        $uperApp = "6 offset-3";
                    } else if ($jmlapp <= 3 && $jmlapp > 1) {
                        $uperApp = 12 / $jmlapp;
                    } else {
                        $uperApp = 6;
                    }

                    $idapp = $rwmenu['idApp'];
                    $kategori = $rwmenu['catApp'];
                    $gambar = $rwmenu['gambarApp'];
                    $namaApp = $rwmenu['namaApp'];
                    $subApp = $rwmenu['subApp'];
                    $linkApp = $rwmenu['linkApp'];

                    echo '<div class="col-xl-' . $uperApp . ' col-lg-' . $uperApp . '  col-md-4 align-items-stretch mb-xl-4 mb-lg-4">';
                    echo '<div id=' . $idapp . ' class="icon-box kotak_app">';
                    echo '<div class="icon"><i class="' . $gambar . '"></i></div>';
                    echo  '<h4 class=""><a href="verify.php?app=' . $idapp . '" target="_blank">' . $namaApp . '</a></h4>';
                    echo '<p class="description">' . $subApp . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        }

        ?>
    </div>
</div>

<script>
    $(document).on("click", ".kotak_app", function() {
        var id = $(this).attr("id");
        window.open("http://localhost:8080/IndeximLP/verify.php?app=" + id, "_blank");
    });
</script>