//ADD OR UPDATE PURPOSE
function purposeFun($idS, $idU){
    event.preventDefault();
    const $form = $('#formPurposeInfo');
    const $input = $form.find('input','textarea');
    const $skincareID = $idS;
    const $userId = $idU;
    const data = [];
    $('.custom-input').each(function () {
        const name = $(this).attr('name');
        const brand = $(this).val();
        const skincare_id = $skincareID;
        const user_id = $userId;
        data.push({ name, brand, user_id, skincare_id});
    });
    
    for (let i = 0; i < data.length; i++) {
        console.log("Name:", data[i].name, "Brand:", data[i].brand,"user_id:", data[i].user_id,"skincare_id:", data[i].skincare_id);
    }

    $input.prop('disabled',true);
    if($('input[name="id"]').val()==""){
        req=$.ajax({
            url: 'requestHandler/purpose/add.php',
            type:'post',
            data: { data: data }
        });
    }else{
        req=$.ajax({
            url: 'requestHandler/purpose/update.php',
            type:'post',
            data: { data: data }
        });
    }

    $input.prop('disabled',false);

    req.done(function(res,textStatus,jqXHR){
        if(res=="Successful"){
            alert("Successfully added purpose");
            console.log(res);
            location.reload();
        }else{
            alert("Error occured while adding purpose")
            console.log(res);
        }
        
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Error '+textStatus, errorThrown)
    });

};
