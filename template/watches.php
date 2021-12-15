<?php

include '../model/config/connect.php';
include '../model/config/includes.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../design/default/header.css">
    <link rel="stylesheet" href="../design/content/watches.css">
    <link rel="stylesheet" href="../design/default/footer.css">
    <title>Our watches | Audemars Piguet</title>
</head>
<body>
    
<?php include 'default/header.php'; ?>

<main>

<section class="filter-results-section">
    <div class="filter-results-container">
        <button class="filter"><p class="bi bi-funnel"> Filter</p><span class="bi bi-plus-lg"></span></button>
        <div class="panel">
            <form action="#" method="post">
            <div class="filter-content">
                <div class="filter-content-grid">
                    <div class="filter-subject">
                        <div class="subject-header"><p class="subject">Collection</p></div>
                        <div class="subject-content">
                            <ul> <?php fetchCollectionFilter() ?></ul>
                        </div>
                    </div>                    
                    <div class="filter-subject">
                        <div class="subject-header"><p class="subject">Calibre</p></div>
                        <div class="subject-content">
                            <ul> <?php fetchCalibreFilter() ?></ul>
                        </div>
                    </div>                    
                    <div class="filter-subject">
                        <div class="subject-header"><p class="subject">Material</p></div>
                        <div class="subject-content">
                            <ul> <?php fetchMaterialFilter() ?></ul>
                        </div>
                    </div>                    
                    <div class="filter-subject">
                        <div class="subject-header"><p class="subject">Case size</p></div>
                        <div class="subject-content">
                            <ul> <?php fetchSizeFilter() ?></ul>
                        </div>
                    </div>                         
                </div>
            </div>
            </form>
        </div>
    </div>
</section>

<section class="watch-results-section">
    <div class="watch-results-container filter_data">
        <script>
            $(document).ready(function(){
                filter_data();

                function filter_data(){
                    $('.filter_data').html('<div id="loading"></div>');
                    var action = 'fetch_data';
                    // create a variable to know which value is filtered.
                    var collection = get_filter('collection');
                    var calibre = get_filter('calibre');
                    var material = get_filter('material');
                    var size = get_filter('size');

                    $.ajax({
                        url:'../index.php?productFunc=5',
                        method:'post',
                        // Simply add a variable and post values together.
                        data:{action:action, collection:collection, calibre:calibre, material:material, size:size},
                        success:function(data){
                            $('.filter_data').html(data);
                        }
                    });
                }

                function get_filter(class_name){
                    var filter = [];
                    $('.'+class_name+':checked').each(function(){
                        filter.push($(this).val());
                    });
                    return filter;
                }

                $('.common_selector').click(function(){
                    filter_data();
                });
            });
        </script>
    </div>
</section>

</main>

<?php include 'default/footer.php'; ?>

<script src="../javascript/default.js"></script>
<script src="../javascript/filter.js"></script>

</body>
</html>