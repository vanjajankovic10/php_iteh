
//ADD OR UPDATE SKINCARE
$('#btnSaveSkincare').click(function (){
    event.preventDefault();
    const $form = $('#formSkincareInfo');
    const $input = $form.find('input');
    const $userID = user_id_js; 
    const data=$form.serialize();

    $input.prop('disabled',true);
    if($('input[name="id"]').val()==""){
        req=$.ajax({
            url: 'requestHandler/skincare/add.php',
            type:'post',
            data: data
        });
    }else{
        req=$.ajax({
            url: 'requestHandler/skincare/update.php',
            type:'post',
            data: data
        });
    }

    $input.prop('disabled',false);

    req.done(function(res,textStatus,jqXHR){
        if(res=="Unsuccessful"){
            alert("Error occured while adding skincare")
            console.log(res);
        }else{
            console.log(res);
            $id = extractAndConvertId(res);
            console.log($id);
            alert("Successfully added skincare");
            purposeFun($id, $userID);
            location.reload();
        }
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Error '+textStatus, errorThrown)
    });

});

function extractAndConvertId(inputString) {
    var parts = inputString.split(' ');
    var idPart = parts[parts.length - 1];
    var id = parseInt(idPart, 10);

    if (!isNaN(id)) {
        return id;
    } else {
        return null;
    }
}

//RESET
$('#resetSkincare').click(function (){
    location.reload();
});

//VIEW
 $('.btnViewSkincare').click(function() {
    console.log($(this).attr('id')); // Log the ID of the clicked button
    $id = extractAndConvertId($(this).attr('id'));
    console.log($id);
    fill($id);
});

//FILL
function fill(idS){
    let id=idS;

    let skincareReq=$.ajax({
        url: 'requestHandler/skincare/get.php',
        type:'post',
        data: {'id':id}
    });
    

    skincareReq.done(function(res,textStatus,jqXHR){

        let skincare = $.parseJSON(res)[0];
        $('input[name="id"]').val(skincare.id);
        $('input[name="name"]').val(skincare.name);
        $('input[name="skin_type"]').val(skincare.skin_type);
        $('input[name="comment"]').val(skincare.comment);

    });

    skincareReq.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska '+textStatus, errorThrown)
    });


    let purposeReq = $.ajax({
        url: 'requestHandler/purpose/get.php', // Replace with the actual URL
        type: 'post',
        data: {'skincare_id': id} // Replace id with the appropriate value
    });
    
    purposeReq.done(function(res, textStatus, jqXHR) {
        console.log(res);
        let cleanser = res[0];
        let toner = res[1];
        let moisturizer = res[2];
        let spf = res[3];
        $('input[name="cleanser"]').val(cleanser.brand);
        $('input[name="toner"]').val(toner.brand);
        $('input[name="moisturizer"]').val(moisturizer.brand);
        $('input[name="spf"]').val(spf.brand);
    });
    
    purposeReq.fail(function(jqXHR, textStatus, errorThrown) {
        console.error('Error ' + textStatus, errorThrown);
    });
}

//DELETE 
$('#deleteSkincare').click(function(){
    let id = $('input[name="id"]').val();
    let id2 = id;
    if(id==""){
        alert("Select skincare routine you want to delete");
        return;
    }

    req=$.ajax({
        url: 'requestHandler/purpose/delete.php',
        type:'post',
        data: {'skincare_id':id}
    });

    req.done(function(res,textStatus,jqXHR){
        if(res=="Successful"){
            alert("Successfully deleted skincare purposes");
            deleteSkincare(id2);
            location.reload();
        }else{
            alert("Error occured while deleting skincare purposes")
            console.log(res);
        }
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Error '+textStatus, errorThrown)
    });

    

});

function deleteSkincare($id){
    let skincareReq=$.ajax({
        url: 'requestHandler/skincare/delete.php',
        type:'post',
        data: {'id':$id}
    });
    

    skincareReq.done(function(res,textStatus,jqXHR){
        if(res=="Successful"){
            alert("Successfully deleted skincare");
            location.reload();
        }else{
            alert("Error occured while deleting skincare")
            console.log(res);
        }
    });

    skincareReq.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Error '+textStatus, errorThrown)
    });
}
