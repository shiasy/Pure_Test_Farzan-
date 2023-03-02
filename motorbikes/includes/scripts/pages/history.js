$(window).on('load', function() {

    sendform(`{"dir":"<?=$_POST[dir]?>","firstlimit":"` + $('.history #firstlimit').val() + `"}`,"load/history",".history .datas #endPageRelaod","before","#search");

    $('#endPageRelaod').on('inview', function (event, isInView) {
        if (isInView) {
            
            if ($('#firstlimit').val()!=0){

                sendform(`{"dir":"<?=$_POST[dir]?>","firstlimit":"` + $('.history #firstlimit').val() + `"}`,"load/history",".history .datas #endPageRelaod","before","#search");
            }


        } else {


        }
    });
    
});