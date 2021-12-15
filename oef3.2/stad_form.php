<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/pdo.php";
require_once "lib/html_functions.php";
require_once "lib/security.php";

PrintHead();
PrintJumbo( $title = "Bewerk afbeelding", $subtitle = "" );

PrintNavbar();
?>

<div class="container">
    <div class="row">

        <?php
            if ( ! is_numeric( $_GET['img_id']) ) die("Ongeldig argument " . $_GET['img_id'] . " opgegeven");

            //get data (model)
            $data = GetData( "select * from images where img_id =" . $_GET['img_id'] );


            $extra['csrf_token'] = GenerateCSRF( "stad_form.php");
            $extra['select_land'] = MakeSelect( $fieldname = 'img_lan_id', $sql = "select lan_id, lan_land from land " ,
            $list_fields = ["lan_id", "lan_land"] , $data[0]["img_lan_id"] );


            //get template (view)
            $template = file_get_contents("templates/stad_form.html");

            //merge (controller)

            $output = MergeViewWithData( $template, $data);
            $output = MergeViewWithExtra($output , $extra  );
            print $output;



        ?>

    </div>
</div>

</body>
</html>