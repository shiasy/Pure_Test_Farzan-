
<div class="slidemenu">

    <div class="profile d-flex align-items-stretch px-0">
        <div class="py-2 mx-auto w-100">
            <p class="mx-auto text-light"  style="border: 3px solid #24e5a3;background: url('<?=(strpos(Config::$setting[body][logo], 'http')===false)?DIR.Config::$setting[body][logo]:Config::$setting[body][logo]?>');background-size: cover;">
                <?=mb_substr($_SESSION[user][name], 0, 1, "UTF-8")?> <?=mb_substr($_SESSION[user][family], 0, 1, "UTF-8")?>
            </p>
            <div class="font-10 text-light px-2 d-none d-lg-flex text-center mt-2">
                <?=$_SESSION[user][name].' '.$_SESSION[user][family].' عزیز خوش آمدید.'?>
            </div>
            
        </div>
    </div>

    

        <div class="slide slideRight d-flex align-items-stretch row">
            
            <div data-toggle="tooltip" title="داشبورد">
                <div class="my-1 py-1 row" onclick='<?=($onclick=='')?'popupback(`{"dir":"'.DIR.'","operator":"list"}`,"pop/popUsers",".body>.pagebody")':$onclick?>' >

                    <img class="imgmenu mr-lg-3 m-auto" src="<?= DIR ?>img/users">
                    <div class="col-12 col-lg pt-1 titleslide">
                        کاربران
                    </div>
                </div>

                <div class="linesplite"></div>
            </div>

            <div data-toggle="tooltip" title="داشبورد">
                <div class="my-1 py-1 row" onclick='<?=($onclick=='')?'popupback(`{"dir":"'.DIR.'","operator":"list"}`,"pop/popMotors",".body>.pagebody")':$onclick?>' >

                    <img class="imgmenu mr-lg-3 m-auto" src="<?= DIR ?>img/dashfactor">
                    <div class="col-12 col-lg pt-1 titleslide">
                        محصولات
                    </div>
                </div>

                <div class="linesplite"></div>
            </div>

            
            <div  data-toggle="tooltip" title="خروج">
                <div class="my-1 py-1 row">

                    <a class="row text-dark" href="logout">
                        <img class="imgmenu mr-lg-3 m-auto" src="<?= DIR ?>img/dashlogout"
                             >
                        <div class="col-12 col-lg pt-1 titleslide">
                            <span  >خروج</span>
                        </div>
                    </a>
                    
                </div>

                <div class="linesplite"></div>
            </div>
            


        </div>
        
    <div class="changeslide d-flex align-items-stretch row">
        <div class="w-100">
            <div id="slideup">
                <img class="imgmenu" src="<?=DIR?>img/slideup/rgb(255,255,255)">
            </div>
        </div>
        <div class="w-100">
            <div id="slidedown">
                <img class="imgmenu" src="<?=DIR?>img/slidedown/rgb(255,255,255)">
            </div>
        </div>
    </div>
</div>

<div class="slidemenuleft">
    
        <div class="slide d-flex align-items-stretch row">
            <div>
                
              


            </div>
        </div>
        <div class="changeslide d-flex align-items-stretch row">
            <div class="w-100">
                <div id="slideup">
                    <img class="imgmenu" src="img/slideup/rgb(255,255,255)">
                </div>
            </div>
            <div class="w-100">
                <div id="slidedown">
                    <img class="imgmenu" src="img/slidedown/rgb(255,255,255)">
                </div>
            </div>
        </div>
        
</div>


<div class="header">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand mx-0" href="<?=DIR?>index"><?=Config::$setting[title]?></a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse px-0" id="collapsibleNavbar">
            <ul class="navbar-nav mt-2 mt-md-0 mx-0 px-0 pr-md-3 pr-lg-5">
                
                <!-- <li class="nav-item">
                    <a class="nav-link border rounded-lg text-center border-secondary" href="javascript:;"
                           onclick='popupback(`{"operator":"docsend","limit":"1","dir":"<?= DIR ?>"}`,"pop/popUser",".body>.pagebody")'>ارسال مدارک</a>
                </li>
                
                <li class="nav-item">
                    <p class="nav-link m-0 text-center">
                        <span class="d-inline d-md-none d-lg-inline">موجودی : </span>
                        <price id="myprice">0</price>
                        ریال
                    </p>
                </li> -->
                
            </ul>
            <div class="col-12 col-md text-left px-0 my-2 mt-3 my-md-0">
                

                <!-- <img src="<?=DIR?>img/login/rgb(48,142,198)" class=" img-md px-1 bg-light border rounded-circle mx-1" onclick='popup(`{"dir":"<?= DIR ?>"}`,"pop/loginapp",".body>.pagebody","append")' data-toggle="tooltip" title="ورود به اپ باشگاه مشتریان">

                <img src="<?=DIR?>img/dashturnbank" class=" img-md px-1 bg-light border rounded-circle mx-1" onclick='popupback(`{"operator":"list","dir":"<?= DIR ?>"}`,"pop/popBanklog",".body>.pagebody")' data-toggle="tooltip" title="تراکنش ها">
                
                <img src="<?=DIR?>img/dashsendratio" data-toggle="modal" data-target="#editmodalbig3" onclick='popupback(`{"operator":"change","type":"ratioshow","dir":"<?= DIR ?>"}`,"pop/popUser","#editmodalbig3 .modal-content")' class=" img-md px-1 bg-light border rounded-circle mx-1" title="تعرفه ارسال">
 -->
                <a class="mx-1" href="logout"  data-toggle="tooltip" title="خروج">
                    <img src="<?=DIR?>img/logout/rgb(48,142,198)" class=" img-md px-1 bg-light border rounded-circle">
                </a>
            </div>
            <script>
            $(document).ready(function(){
              $('[data-toggle="tooltip"]').tooltip();
            });
            </script>
        </div>
    </nav>
</div>

<div class="footer d-flex">
    <div class="my-auto mx-auto text-center px-2">تمامی حقوق مادی و معنوی این وب سایت متعلق به شرکت <span class="text-success"><?=Config::$setting[copyrighttitle]?></span> می باشد.</div>
</div>

<script type="text/javascript">

    

    // $(document).ready(function(){
    //     var formData = new FormData();

    //     formData.set('operator', 'myprice');

    //     setInterval(function () {
    //         $.ajax({
    //             type:"POST",
    //             url:'<?=DIR?>pop/ajax',
    //             dataType: 'html',
    //             cache: false,
    //             contentType: false,
    //             processData: false,
    //             data: formData,
    //             success: function(result){
    //                 result=FormatNumberBy3(result);
    //                 valmyprice=$('#myprice').html();
    //                 if (valmyprice!=result){
    //                     $('#myprice').html(result);
    //                 }

    //                 // console.clear();
    //             }

    //         });
    //     },5000);
    // });




</script>
